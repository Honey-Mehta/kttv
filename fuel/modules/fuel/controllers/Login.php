<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
class Login extends Fuel_base_controller {

	public function __construct()
	{
		parent::__construct(false);

		// for flash data
		$this->load->library('session');

		if (!$this->fuel->config('admin_enabled')) show_404();

		$this->load->vars(array(
			'js' => '', 
			'css' => css($this->fuel->config('xtra_css')), // use CSS function here because of the asset library path changes below
			'js_controller_params' => array(), 
			'keyboard_shortcuts' => $this->fuel->config('keyboard_shortcuts')));

		// change assets path to admin
		$this->asset->assets_path = $this->fuel->config('fuel_assets_path');

		// set asset output settings
		$this->asset->assets_output = $this->fuel->config('fuel_assets_output');
		
		$this->lang->load('fuel');
		$this->load->helper('ajax');
		$this->load->library('form_builder');

		$this->load->module_model(FUEL_FOLDER, 'fuel_users_model');

		// set configuration paths for assets in case they are different from front end
		$this->asset->assets_module ='fuel';
		$this->asset->assets_folders = array(
				'images' => 'images/',
				'css' => 'css/',
				'js' => 'js/',
			);

	}

	public function index()
	{
		// check if it's a password request and redirect'
		if ($this->uri->segment(3) == 'pwd_reset')
		{
			$this->pwd_reset();
			return;
		}
		else if ($this->uri->segment(3) == 'dev')
		{
			$this->dev();
			return;
		}
		else if ($this->uri->segment(3) == 'reset')
		{
			$this->reset_password();
			return;
		}

		$this->js_controller_params['method'] = 'add_edit';

		$this->load->helper('convert');
		$this->load->helper('cookie');

		$session_key = $this->fuel->auth->get_session_namespace();

		$user_data = $this->session->userdata($session_key);

		if ( ! empty($_POST))
		{
			// XSS key check
			if (!$this->_is_valid_csrf())
			{
				add_error(lang('error_csrf'));
			}

			// check if they are locked out out or not
			elseif (isset($user_data['failed_login_timer']) AND (time() - $user_data['failed_login_timer']) < (int)$this->fuel->config('seconds_to_unlock'))
			{
 				$this->fuel_users_model->add_error(lang('error_max_attempts', $this->fuel->config('seconds_to_unlock')));
				$user_data['failed_login_timer'] = time();
			}
			else
			{
				if ($this->input->post('user_name') AND $this->input->post('password'))
				{
					if ($this->fuel->auth->login($this->input->post('user_name', TRUE), $this->input->post('password', TRUE)))
					{
						// reset failed login attempts
						$user_data['failed_login_timer'] = 0;

						// Problems using CI set_cookie helper in CI 3.1.13 so resorted to native PHP.
						setcookie($this->fuel->auth->get_fuel_trigger_cookie_name(), serialize(array('id' => $this->fuel->auth->user_data('id'), 'language' => $this->fuel->auth->user_data('language'))), 0, $this->fuel->config('fuel_cookie_path'));

						$forward = $this->input->post('forward');
						$forward_uri = uri_safe_decode($forward);

						# Check URL for naughty forwarding
						$parsed_url = parse_url($forward_uri); 
						$host = array_key_exists('host', $parsed_url) ? $parsed_url['host'] : null;

						if ($forward AND ($forward_uri != $this->fuel->config('login_redirect')) AND ($host === null))
						{
							redirect($forward_uri);
						}
						else
						{
							redirect($this->fuel->config('login_redirect'));
						}
					}
					else
					{
						$this->check_login_attempts($user_data, 'username');

					}
				}
				else
				{
					$this->fuel_users_model->add_error(lang('error_empty_user_pwd'));
				}
			}

			$this->session->set_userdata($session_key, $user_data);
		}
		
		// build form
		$this->form_builder->set_validator($this->fuel_users_model->get_validation());
		$fields['user_name'] = array('size' => 25, 'placeholder' => 'username', 'display_label' => FALSE, 'autocomplete'=>'off');
		$fields['password'] = array('type' => 'password', 'size' => 25, 'placeholder' => 'password', 'display_label' => FALSE, 'autocomplete'=>'off');
		$fields['forward'] = array('type' => 'hidden', 'value' => fuel_uri_segment(2));
		$this->form_builder->show_required = FALSE;
		$this->form_builder->form_attrs = 'method="post" action="" id="form" autocomplete="off"';
		$this->form_builder->submit_value = lang('login_btn');
		// $this->form_builder->use_form_tag = FALSE;
		$this->form_builder->set_fields($fields);
		$this->form_builder->remove_js();
		$form_inputs = $this->input->post(NULL, TRUE);
		unset($form_inputs['password']);
		if (!empty($_POST)) $this->form_builder->set_field_values($form_inputs);
		$this->_prep_csrf();

		$vars['form'] = $this->form_builder->render();
		
		// set any errors that 
		if ($this->session->flashdata('error'))
		{
			$errors = array($this->session->flashdata('error'));
		}
		else
		{
			$errors =  $this->fuel_users_model->get_errors();
		}
		
		$vars['error'] = $errors;

		// notifications template
		$notifications = $this->load->view('_blocks/notifications', $vars, TRUE);
		$vars['notifications'] = $notifications;
		$vars['display_forgotten_pwd'] = $this->fuel->config('allow_forgotten_password');
		$vars['page_title'] = lang('fuel_page_title');

		$this->load_view('login', $vars);
	}

	// THIS IS A PASSWORD RESET TOKEN CREATION EMAIL SENDING 
	public function pwd_reset()
	{
		if ( ! $this->fuel->config('allow_forgotten_password')) show_404();

		$this->js_controller_params['method'] = 'add_edit';

		$session_key = $this->fuel->auth->get_session_namespace();

		$user_data = $this->session->userdata($session_key);

		if ( ! empty($_POST))
		{
			// XSS key check
			if (!$this->_is_valid_csrf())
			{
				add_error(lang('error_csrf'));
			}
			elseif (isset($user_data['failed_login_timer']) AND (time() - $user_data['failed_login_timer']) < (int)$this->fuel->config('seconds_to_unlock'))
			{
 				$this->fuel_users_model->add_error(lang('error_max_attempts', $this->fuel->config('seconds_to_unlock')));
			}
			elseif ($this->input->post('email'))
			{
				$user = $this->fuel_users_model->find_one_array(array('email' => $this->input->post('email')));

				if ( ! empty($user['email']))
				{
					// reset failed login attempts
					$user_data['failed_login_timer'] = 0;

					// This generates and saves a token to the user model, returns the token string.
					$token = $this->fuel_users_model->get_reset_password_token($user['email']);

					if ($token !== FALSE)
					{
						$url = 'login/reset/' . $token;
						$msg = lang('pwd_reset_email', fuel_url($url));
						$params['to'] = $this->input->post('email');
						$params['subject'] = lang('pwd_reset_subject');
						$params['message'] = $msg;
						$params['use_dev_mode'] = FALSE;

						// var_dump($msg); die;
						if ($this->fuel->notification->send($params))
						{
							// echo $msg; die;
							// set email sent time in failed_login_timer to prevert email flooding
							$user_data['failed_login_timer'] = time();

							$this->session->set_flashdata('success', lang('pwd_reset_email_success'));
							$this->fuel->logs->write(lang('auth_log_pass_reset_request', $user['email'], $this->input->ip_address()), 'debug');
						}
						else
						{
							// Reset the key back to empty if not successful send
							$user['reset_key'] = '';
							$user['reset_key'] = $token;
							$this->fuel_users_model->save($user);
							$this->session->set_flashdata('error', lang('error_pwd_reset'));
							$this->fuel->logs->write($this->fuel->notification->last_error(), 'debug');
						}
						
						$this->session->set_userdata($session_key, $user_data);
						redirect(fuel_uri('login'));
					}
					else
					{
						$this->fuel_users_model->add_error(lang('error_invalid_email'));
					}
				}
				else
				{
					$this->check_login_attempts($user_data, 'email');
				}

				$this->session->set_userdata($session_key, $user_data);
			}
			else
			{
				$this->fuel_users_model->add_error(lang('error_empty_email'));
			}
		}

		$this->form_builder->set_validator($this->fuel_users_model->get_validation());
		
		// build form
		$fields['Reset Password'] = array('type' => 'section', 'label' => lang('login_reset_pwd'));
		$fields['email'] = array('required' => TRUE, 'size' => 30, 'placeholder' => 'enter email address', 'display_label' => FALSE, 'autocomplete'=>'off');

		$this->form_builder->show_required = FALSE;
		$this->form_builder->use_form_tag = FALSE;
		$this->form_builder->set_fields($fields);
		$this->_prep_csrf();

		$vars['form'] = $this->form_builder->render();
		
		// notifications template
		$vars['error'] = $this->fuel_users_model->get_errors();
		$vars['notifications'] = $this->load->module_view(FUEL_FOLDER, '_blocks/notifications', $vars, TRUE);
		$vars['page_title'] = lang('fuel_page_title');

		$this->load_view('pwd_reset', $vars);

	}

	protected function check_login_attempts(&$user_data, $field)
	{
		if (isset($user_data['failed_login_timer']) AND (time() - $user_data['failed_login_timer']) > (int)$this->fuel->config('seconds_to_unlock'))
		{
			$user_data['failed_login_attempts'] = 0;
			$this->session->unset_userdata('failed_login_timer');
			unset($user_data['failed_login_timer']);
		}
		else
		{
			// add to the number of attempts if it's an invalid login'
			$num_attempts = (!isset($user_data['failed_login_attempts'])) ? 0 : $user_data['failed_login_attempts'] + 1;
			$user_data['failed_login_attempts'] = $num_attempts;
		}

		// check if they should be locked out
		if (isset($user_data['failed_login_attempts']) AND $user_data['failed_login_attempts'] >= (int)$this->fuel->config('num_logins_before_lock') -1)
		{
			$this->fuel_users_model->add_error(lang('error_max_attempts', $this->fuel->config('seconds_to_unlock')));
			$user_data['failed_login_timer'] = time();
			$this->fuel->logs->write(lang('auth_log_account_lockout', $this->input->post($field, TRUE), $this->input->ip_address()), 'debug');
		}
		else
		{
			if ($field == 'email')
			{
				$this->fuel_users_model->add_error(lang('error_invalid_email'));
				$this->fuel->logs->write(lang('error_invalid_email', $this->input->post('email', TRUE), $this->input->ip_address(), ($user_data['failed_login_attempts'] + 1)), 'debug');
			}
			else
			{
				$this->fuel_users_model->add_error(lang('error_invalid_login'));
				$this->fuel->logs->write(lang('auth_log_failed_login', $this->input->post('user_name', TRUE), $this->input->ip_address(), ($user_data['failed_login_attempts'] + 1)), 'debug');
			}
		}
	}

	// THIS HANDLES A POST REQUEST FOR USER SETTING A NEW PASSWORD
	public function reset_password() 
	{
		$token = $this->uri->segment(4);

		if (empty($token))
		{
			$this->session->set_flashdata('error', lang('pwd_reset_missing_token'));
			redirect(site_url('fuel/login'));
		}
		else
		{
			if( ! $this->fuel_users_model->validate_reset_token($token))
			{
				$this->session->set_flashdata('error', lang('pwd_reset_missing_token'));
				redirect(site_url('fuel/login'));
			}
		}
		
		if ( ! empty($_POST))
		{
			// XSS key check
			if (!$this->_is_valid_csrf())
			{
				add_error(lang('error_csrf'));
			}
			elseif ($this->input->post('email') && $this->input->post('password') && $this->input->post('password_confirm') && $this->input->post('_token'))
			{
				$this->load->library('user_agent');
			
				if ($this->input->post('password') == $this->input->post('password_confirm'))
				{
				   	$reset = $this->fuel_users_model->reset_password_from_token($this->input->post('email'), $this->input->post('_token'), $this->input->post('password'));

					if ($reset)
					{
						$this->session->set_flashdata('success', lang('pwd_reset_success'));
						redirect(site_url('fuel/login'));
					}
					else
					{
						if ($this->fuel_users_model->has_error())
						{
							$errors = $this->fuel_users_model->get_errors();
							$this->session->set_flashdata('error',$errors[0]);
							redirect($this->agent->referrer());
						}

						$this->session->set_flashdata('error', lang('pwd_reset_error'));
						redirect(site_url('fuel/login/pwd_reset'));
					}
				}
				else
				{
					$this->session->set_flashdata('error', lang('pwd_reset_error_not_match'));
					redirect($this->agent->referrer());
				}
			}
		}
		
		$fields['Reset Password'] = array('type' => 'section', 'label' => lang('login_reset_pwd'));
		$fields['Directions'] = array('type' => 'copy', 'label' => $this->fuel->users->get_password_strength_text());
		$fields['email'] = array('required' => TRUE, 'size' => 30, 'placeholder' => 'email', 'display_label' => FALSE, 'autocomplete'=>'off');
		$fields['password'] = array('type' => 'password', 'required' => TRUE, 'size' => 30, 'placeholder' => 'password', 'display_label' => FALSE, 'autocomplete'=>'off');
		$fields['password_confirm'] = array('type' => 'password', 'required' => TRUE, 'size' => 30, 'placeholder' => 'confirm password', 'display_label' => FALSE, 'autocomplete'=>'off');
		$fields['_token'] = array('type' => 'hidden', 'value' => $token);

		$this->form_builder->show_required = FALSE;
		$this->form_builder->use_form_tag = FALSE;
		$this->form_builder->set_fields($fields);
		$this->form_builder->form_attrs = 'method="post" action="" id="form" autocomplete="off"';
		$this->_prep_csrf();

		$vars['form'] = $this->form_builder->render();
		
		// notifications template
		$vars['error'] = $this->fuel_users_model->get_errors();
		$vars['notifications'] = $this->load->module_view(FUEL_FOLDER, '_blocks/notifications', $vars, TRUE);
		$vars['page_title'] = lang('fuel_page_title');

		$this->load_view('reset', $vars);
	}

	public function dev()
	{
		if(empty($this->fuel->config('dev_password')))
		{
			set_status_header(404);
			return;
		}
		$this->config->set_item('allow_forgotten_password', FALSE);

		if ( ! empty($_POST))
		{
			// XSS key check
			if (!$this->_is_valid_csrf())
			{
				add_error(lang('error_csrf'));
			}
			elseif ( ! $this->fuel->config('dev_password'))
			{
				redirect('');
			}
			else if ($this->fuel->config('dev_password') == $this->input->post('password', TRUE))
			{
				$this->load->helper('convert');
				$this->session->set_userdata('dev_password', TRUE);
				$forward = uri_safe_decode($this->input->post('forward'));
				redirect($forward);
			}
			else
			{
				add_error(lang('error_invalid_login'));
			}
		}

		$fields['password'] = array('type' => 'password', 'placeholder' => 'password', 'display_label' => FALSE, 'size' => 25);
		$fields['forward'] = array('type' => 'hidden', 'value' => fuel_uri_segment(2));

		$this->form_builder->show_required = FALSE;
		$this->form_builder->submit_value = 'Login';
		$this->form_builder->use_form_tag = FALSE;
		$this->form_builder->set_fields($fields);
		if ( ! empty($_POST)) $this->form_builder->set_field_values($this->input->post(NULL, TRUE));
		$this->_prep_csrf();

		$vars['form'] = $this->form_builder->render();
		$vars['notifications'] = $this->load->module_view(FUEL_FOLDER, '_blocks/notifications', $vars, TRUE);
		$vars['display_forgotten_pwd'] = FALSE;
		$vars['instructions'] = lang('dev_pwd_instructions');
		$vars['page_title'] = lang('fuel_page_title');

		$this->load_view('login', $vars);
	}

	protected function load_view($view, $vars = array())
	{
		if (file_exists(APPPATH.'views/_admin/'.$view.'.php'))
		{
			$this->load->module_view('app', '_admin/'.$view, $vars);
		}
		else
		{
			$this->load->module_view(FUEL_FOLDER, $view, $vars);
		}
	}
}

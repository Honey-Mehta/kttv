<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class My_profile extends Fuel_base_controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->module_model(FUEL_FOLDER, 'fuel_users_model');
		$this->load->library('form_builder');
	}
	
	public function edit()
	{
		$user = $this->fuel->auth->user_data();
		$id = $user['id'];

		if ( ! empty($_POST))
		{
			if (!$this->_is_valid_csrf())
			{
				add_error(lang('error_saving'));
			}
			else if ($id)
			{
				// make sure they are only 
				if ($id != $this->fuel->auth->user_data('id'))
				{
					show_error(lang('error_no_permissions'));
				}

				$save = $this->input->post(NULL, TRUE);
				$save['id'] = $id;

				if(empty($this->input->post('old_password'))) {
					$this->fuel_users_model->required[] = 'old_password';
				}
				
				if ($this->input->post('user_name') AND $this->input->post('old_password'))
				{
					
					// if(empty($this->input->post('new_password'))) {
					// 	$this->fuel_users_model->required[] = 'new_password';
					// }

					
					if ( $this->fuel->auth->login($this->input->post('user_name', TRUE), $this->input->post('old_password', TRUE)))
					{
						if ($this->fuel_users_model->save($save))
						{
							$this->fuel->admin->set_notification(lang('data_saved'), Fuel_admin::NOTIFICATION_SUCCESS);
							redirect(fuel_uri('my_profile/edit/'));
						}

					} else {
						
						$this->fuel_users_model->add_error('Old password does not match.');
						$this->fuel->logs->write(lang('auth_log_failed_login', $this->input->post('user_name', TRUE), $this->input->ip_address(), 'my_profile/edit'), 'debug');
						
						// $this->fuel->admin->set_notification('Old password does not match.', Fuel_admin::NOTIFICATION_ERROR);
						// redirect(fuel_uri('my_profile/edit/'));
					}
					
				} 
				else if ($this->fuel_users_model->save($save))
				{
					$this->fuel->admin->set_notification(lang('data_saved'), Fuel_admin::NOTIFICATION_SUCCESS);
					redirect(fuel_uri('my_profile/edit/'));
				}
			}
		}

		$this->_form($id);
	}

	// separated to make it easier in subclasses to use the form without rendering the page
	public function _form($id = null)
	{
		$this->load->helper('security');
		$this->js_controller_params['method'] = 'add_edit';

		// create fields... start with the table info and go from there
		$values = array('id' => $id);
		$fields = $this->fuel_users_model->form_fields($values);

		// get saved data
		$saved = array();

		if ( ! empty($id))
		{
			$saved = $this->fuel_users_model->user_info($id);
		}

		// remove active from field list to prevent them from updating it
		unset($fields['active'], $fields['Permissions'], $fields['permissions'], $fields['is_invite'], $fields['id']);

		if ( ! empty($_POST))
		{
			$field_values = $this->fuel_users_model->clean();
		}
		else
		{
			$field_values = $saved;
		}

		// XSS key check
		$this->form_builder->form->validator = &$this->fuel_users_model->get_validation();
		$this->form_builder->submit_value = lang('btn_save');
		$this->form_builder->use_form_tag = false;
		// extended
		$fields['old_password'] = array(
			'order' => 4.5,
			'type' => 'password',
			'size' => 25, 
			'autocomplete'=>'off',
			'required'=> true, 
			'comment' => 'Current password is mandatory to change/modify in profile.',
		);

		$fields['new_password']['comment'] = 'Only enter new password, If require to change in password. 
			Password must be: 
			A minimum of 8 characters,
			A maximum of 20 characters,
			One or more lower case letters,
			One or more upper case letters,
			One or more numbers,
			One or more symbols (e.g. +_!@#$\%^&*.,?-)';

		// var_dump($fields); die;
		// var_dump($field_values); die;

		$this->form_builder->set_fields($fields);
		$this->form_builder->display_errors = true;
		$this->form_builder->set_field_values($field_values);

		$this->_prep_csrf();

		$vars['form'] = $this->form_builder->render();

		// other variables
		$vars['id'] = $id;
		$vars['data'] = $saved;

		// active or publish fields
		$errors = $this->fuel_users_model->get_errors();

		if ( ! empty($errors)) add_errors($errors);

		$this->fuel->admin->set_titlebar_icon('ico_users');

		$crumbs = lang('section_my_profile');
		$this->fuel->admin->set_titlebar($crumbs);
		$this->fuel->admin->render('my_profile', $vars, '', FUEL_FOLDER);
	}

}
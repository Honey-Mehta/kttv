<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Base_module_model.php');
class Depart_news_model extends Base_module_model {

	public $required = array('headline');
	public $filters = array('group_id'); // the default list view group value for filtering
	public $record_class = 'depart_news_item';
	public $parsed_fields = array('content');
	
	function __construct()
	{
		parent::__construct('departmental_news'); // table name
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'release_date', $order = 'desc', $just_count = false)
	{	
		$CI =& get_instance();

		if (!$CI->fuel->auth->is_super_admin())
		{
			$this->db->where(array('group_id' => $CI->fuel->auth->get_role_id()));
		}
		$this->db->select('user_role.name AS Department,departmental_news.id, release_date, headline, published');
		$this->db->join($this->_tables['fuel_user_role'], $this->_tables['fuel_user_role'].'.id = '.$this->_tables['departmental_news'].'.group_id', 'left');
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}


	function on_before_clean($values)
	{

		if (!intval($values['release_date'])) $values['release_date'] = datetime_now();
		return $values;
	}

	function form_fields($values = array(), $related = array())
	{	
		$fields = parent::form_fields();
		$CI =& get_instance();

		// user group
		if (empty($CI->fuel_user_roles_model)){
			$CI->load->module_model(FUEL_FOLDER, 'fuel_user_roles_model');
		}
		
		if (!$CI->fuel->auth->is_super_admin())
		{
			unset($fields['group_id']);
			//$this->session->set_flashdata('success','Please make sure you also send an email to the customer');
		} else {

			$fields['group_id'] = array(
				'label' => 'Department',
				'type' => 'select', 
				'options' => $CI->fuel_user_roles_model->options_list(),
				'comment' => 'The grouping of Department you want to associate this alumni to',
				'required'=>TRUE,
				'order' => 3
			);
		}
		$fields['link']['comment'] = 'Provide a link of attachment (Optional)';
		$fields['link']['label'] = 'Full Link';

		$fields['isexternal']['label'] = 'Link is external';
		$fields['release_date']['comment'] = 'A release date will automatically be created for you of the current date if left blank';
		return $fields;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Determines whether a user has edit permission/assigned 
	 *
	 * @access	public
	 * @param	string The ref id
	 * @return	boolean 
	 */	
	public function is_assigned_depart($id)
	{
		$CI =& get_instance();
		return $this->record_exists(array('id' => $id, 'group_id' => $CI->fuel->auth->get_role_id()));
		
	}

	// --------------------------------------------------------------------
	
	/**
	 * Model hook executed right before validation is run
	 *
	 * @access	public
	 * @param	array The values to be saved right before validation
	 * @return	array Returns the values to be validated right before saving
	 */	
	public function on_before_validate($values)
	{
		

		if (!empty($values['id']))
		{
						
			$CI =& get_instance();
			if (!$CI->fuel->auth->is_super_admin())
			{
				$this->add_validation('id', array(&$this, 'is_assigned_depart'), 'You don\'t have permission to edit this News.');

			} 
			
		}

		return $values;
	}

	/**
	 * Model hook executed right before saving
	 *
	 * @access	public
	 * @param	array The values to be saved right before saving
	 * @return	array Returns the values to be saved
	 */	
	public function on_before_save($values)
	{
		$CI = get_instance();
		
		if (!$CI->fuel->auth->is_super_admin())
		{
			$values['group_id'] = $CI->fuel->auth->user_data('role_id');
		}
		return $values;
	}

	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		$this->db->select($this->_tables['departmental_news'].'.*,'. $this->_tables['fuel_user_role'].'.name');
		$this->db->join($this->_tables['fuel_user_role'], $this->_tables['fuel_user_role'].'.id = '.$this->_tables['departmental_news'].'.group_id', 'left');
		$this->db->order_by('release_date desc');
	}
}

class Depart_news_item_model extends Base_module_record {

	protected $_date_format = 'F d, Y';
	
	function get_url()
	{
		if (!empty($this->link)) {

			if($this->_isexternal($this->link)){
				return $this->link;
			} 
		}

		return site_url('/'.$this->slug);
	}
	
	function get_excerpt_formatted($char_limit = NULL, $readmore = '')
	{
		$this->_CI->load->helper('typography');
		$this->_CI->load->helper('text');
		$excerpt = $this->content;

		if (!empty($char_limit))
		{
			// must strip tags to get accruate character count
			$excerpt = strip_tags($excerpt);
			$excerpt = character_limiter($excerpt, $char_limit);
		}
		$excerpt = auto_typography($excerpt);
		$excerpt = $this->_parse($excerpt);
		if (!empty($readmore))
		{
			$excerpt .= ' '.anchor($this->get_url(), $readmore, 'class="readmore"');
		}
		return $excerpt;
	}

	function _isexternal($url)
	{
	  $components = parse_url($url);    
	  return !empty($components['host']) && strcasecmp($components['host'], $_SERVER['SERVER_NAME']);
	}
	
}
?>

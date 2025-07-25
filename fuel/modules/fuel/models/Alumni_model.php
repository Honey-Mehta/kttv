<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Base_module_model.php');
class Alumni_model extends Base_module_model {

	public $required = array('name','occupation','mobile','passing_year','degree');
	public $filters = array('group_id'); // the default list view group value for filtering
	public $record_class = 'alumni_item';
	//public $parsed_fields = array('content');
	
	function __construct()
	{
		parent::__construct('tbl_alumni'); // table name
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'created', $order = 'desc', $just_count = false)
	{
		//$this->db->select('id, release_date, headline, slug, published');
		$CI =& get_instance();

		if (!$CI->fuel->auth->is_super_admin())
		{
			$this->db->where(array('group_id' => $CI->fuel->auth->get_role_id()));
		}
		$this->db->select('user_role.name AS Department,tbl_alumni.name,occupation,mobile,email,passing_year,city,published,'.$this->_tables['tbl_alumni'].'.id');
		$this->db->join($this->_tables['fuel_user_role'], $this->_tables['fuel_user_role'].'.id = '.$this->_tables['tbl_alumni'].'.group_id', 'left');
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
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
		$fields['address']['type'] = 'char';
		unset($fields['created']); 
		return $fields;
	}

	function on_before_clean($values)
	{
		//if (empty($values['slug'])) $values['slug'] = url_title($values['headline'], 'dash', TRUE);
		$values['created'] = datetime_now();
		return $values;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Determines whether a user has edit permission/assigned 
	 *
	 * @access	public
	 * @param	string The ref id
	 * @return	boolean 
	 */	
	public function is_assigned_alumni($id)
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
				$this->add_validation('id', array(&$this, 'is_assigned_alumni'), 'You don\'t have permission to edit this Alumni.');

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
		$this->db->select('user_role.name AS Department,'.$this->_tables['tbl_alumni'].'.*');
		$this->db->join($this->_tables['fuel_user_role'], $this->_tables['fuel_user_role'].'.id = '.$this->_tables['tbl_alumni'].'.group_id', 'left');
		//$this->db->order_by('release_date desc');
	}
}

class Alumni_item_model extends Base_module_record {
	
}
?>

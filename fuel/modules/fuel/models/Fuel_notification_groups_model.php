<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

// ------------------------------------------------------------------------

/**
 * Extends Base_module_model
 *
 * <strong>Fuel_notification_groups_model</strong> is used for managing notification Group in the CMS
 * 
 * @package		FUEL CMS
 * @subpackage	Models
 * @category	Models
 * @author		David McReynolds @ Daylight Studio
 * @link		http://docs.getfuelcms.com/models/Fuel_notification_groups_model
 */

require_once('Base_module_model.php');

class Fuel_notification_groups_model extends Base_module_model {
	
	public $unique_fields = array('name'); // The name field is unique
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @return	void
	 */	
	public function __construct()
	{
		$CI =& get_instance();
		$tables = $CI->config->item('tables', 'fuel');
		parent::__construct($tables['fuel_notification_groups']);
		$this->add_validation('name', array(&$this, 'valid_name'), lang('error_requires_string_value'));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Validation callback function. Navigation group names must not be numeric.
	 *
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */	
	public function valid_name($name)
	{
		return (!is_numeric($name));
	}

	// --------------------------------------------------------------------
	
	/**
	 * Cleanup navigation items if group is deleted
	 *
	 * @access	public
	 * @param	mixed The where condition for the delete
	 * @return	void
	 */	
	 public function on_after_delete($where)
	 {
		$this->delete_related(array(FUEL_FOLDER => 'notification_model'), 'group_id', $where);
	 }
}

class Fuel_notification_group_model extends Base_module_record {
}

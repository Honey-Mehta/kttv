<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

// ------------------------------------------------------------------------

/**
 * Extends Base_module_model
 *
 * <strong>Fuel_role_groups_model</strong> is used for managing Role Group in the CMS
 * 
 * @package		FUEL CMS
 * @subpackage	Models
 * @category	Models
 * @author		Nitin Nagar @ MPOnline Limited
 */

require_once('Base_module_model.php');

class Fuel_user_roles_model extends Base_module_model {
	
	public $unique_fields = array('name'); // The name field is unique
	public $filters = array('id'); // the default list view group value for filtering
	public $record_class = 'fuel_user_role_item';
	// --------------------------------------------------------------------
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @return	void
	 */	
	public function __construct()
	{
		parent::__construct('fuel_user_role');

	}
	


	function form_fields($values = array(),$related = array())
	{	
		$fields = parent::form_fields();
		$fields['base_location']['label'] = 'Location (Optional)' ;
		$fields['base_location']['comment'] = "Add the part of the url after the root of your site (usually after the domain name). For the departments/hindi, just put the word 'hindi'. If left black system will create location automatically.";
		return $fields;

	}

	// --------------------------------------------------------------------
	
	/**
	 * Displays related items on the right side
	 *
	 * @access	public
	 * @param	array View variable data (optional)
	 * @return	mixed Can be an array of items or a string value
	 */	
	public function related_items($values = array())
	{
		if (empty($values)) return '';

		$CI =& get_instance();
		// don't display if it is disabled
		if ($CI->fuel->modules->get('navigation')->info('disabled') === TRUE) return '';

		$CI->load->module_model(FUEL_FOLDER, 'fuel_navigation_model');

		$where['location'] = $values['base_location'];
		$related_items = $CI->fuel_navigation_model->find_all_array_assoc('id', $where);
		$return = array();
		if (!empty($related_items))
		{
			$return['navigation'] = array();

			foreach($related_items as $key => $item)
			{
				$label = $item['label'];
				if (!empty($item['group_name']))
				{
					$label .= ' ('.$item['group_name'].')';
				}
				$return['navigation']['inline_edit/'.$key] = $label;
			}
		}
		else if (!empty($values['base_location']) AND $this->fuel->auth->has_permission('navigation', 'create'))
		{

			$return['navigation'] = array();
			$label = (!empty($values['name'])) ? $values['name'] : '';
			$parent_id = 0;
			$group_id = $CI->fuel->config('auto_page_navigation_group_id');

			// determine parent based off of location
			$location_arr = explode('/', $values['base_location']);
			$parent_location = implode('/', array_slice($location_arr, 0, (count($location_arr) -1)));
		
			if (!empty($parent_location)) $parent = $this->fuel_navigation_model->find_by_location($parent_location);
			if (!empty($parent))
			{
				$parent_id = $parent['id'];
			}
			$return['navigation']['inline_create?location='.urlencode($values['base_location']).'&label='.$label.'&group_id='.$group_id.'&parent_id='.$parent_id] = lang('navigation_related');
		}
		$view = $this->load->module_view(FUEL_FOLDER, '_blocks/related_items_array', array('related_items' => $return), TRUE);
		$layout = $CI->fuel->layouts->get('main');

		if (!empty($layout->preview_image))
		{
			$img_path = (is_http_path($layout->preview_image) OR substr($layout->preview_image, 0, 1) == '/') ? $layout->preview_image : img_path($layout->preview_image);
			$view = '<img src="'.$img_path.'" alt="'.$layout->name().'" class="layout_preview" />'.$view;
		}

		return $view;
	}

	function on_before_clean($values)
	{
		if (empty($values['base_location'])) $values['base_location'] = url_title($values['name'], 'dash', TRUE);
		$values['base_location'] = str_replace('departments/', '', $values['base_location']);
		$values['base_location'] = 'departments/'.url_title($values['base_location'], 'dash', TRUE);
		return $values;
	}

	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		$this->db->order_by('id ASC');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Validation callback function. role group names must not be numeric.
	 *
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */	

	public function valid_name($name)
	{
		return (!is_numeric($name));
	}
	public function on_before_validate($values)
	{
		// var_dump($values);die;
		if (!empty ($values['name'])) {
			$name = $values['name'];
			if (!preg_match('/^[A-Za-z\-]+$/',$name)) {
				$this->add_error('Only alphabetical characters allowed in name', 'name');
				return;
			}
		}
		if (!empty ($values['base_location'])) {
			$base_location = $values['base_location'];
			if (!preg_match('/^[A-Za-z0-9\x{0900}-\x{097F}\-\/, ]+$/u', $base_location)) {
				$this->add_error('Only alphanumeric and hindi characters allowed in base location', 'base_location');
				return;
			}
		}
		return $values;
	}
}

class Fuel_user_role_item_model extends Base_module_record {

}

<?php if (!defined('BASEPATH'))
	exit ('No direct script access allowed');
require_once ('Base_module_model.php');
class Events_model extends Base_module_model
{

	public $required = array('headline');
	public $filters = array('group_id'); // the default list view group value for filtering
	public $record_class = 'notification_item';
	public $parsed_fields = array('content');

	function __construct()
	{
		parent::__construct('events'); // table name
		//echo 'notification'; die;
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'release_date', $order = 'desc', $just_count = false)
	{
		$this->db->select('id, release_date, headline, slug, published');
		$data = parent::list_items($limit, $offset, $col, $order);
		
		return $data;
	}


	function on_before_clean($values)
	{
		if (empty ($values['slug']))
			$values['slug'] = url_title($values['headline'], 'dash', TRUE);
		if (!intval($values['release_date']))
			// $values['release_date'] = datetime_now();
			$values['release_date'] = date('Y-m-d', strtotime($values['release_date']));

			// if(empty($values['release_date']))
			// {
			// 	echo 'test'; die;
			// 	$values['release_date'] = date('Y-m-d', strtotime(date()));
			// }
		return $values;
	}

	function form_fields($values = array(), $related = array())
	{
		$fields = parent::form_fields();
		$CI =& get_instance();
		// notification group
		// if (empty ($CI->fuel_notification_groups_model)) {
		// 	$CI->load->module_model(FUEL_FOLDER, 'fuel_notification_groups_model');
		// }
		// $group_options = $CI->fuel_notification_groups_model->options_list();

		$fields['link'] = array(
			'ignore_representative' => TRUE,
			'type' => 'asset',
			'multiple' => FALSE,
			'folder' => 'notification',
			'hide_options' => TRUE,
			'comment' => 'Provide a link of attachment (Optional)'
		);
		//$fields['test_image'] = array('upload' => TRUE);

		// $fields['group_id'] = array(
		// 	'type' => 'inline_edit',
		// 	'module' => 'notification_group',
		// 	'options' => $group_options,
		// 	//'class' => 'add_edit navigation_group', 
		// 	'comment' => 'The grouping of items you want to associate this notification item to'
		// );
		$fields['slug']['comment'] = 'If no slug is provided, one will be provided for you';
		$fields['release_date']['comment'] = 'A release date will automatically be created for you of the current date if left blank';
		// $fields['isexternal']['label'] = 'is External Link';
		// $fields['isexternal']['comment'] = 'Open in new window';
		return $fields;
	}

	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		// $this->db->select($this->_tables['notification'] . '.*,' . $this->_tables['fuel_notification_groups'] . '.name');
		// $this->db->join($this->_tables['fuel_notification_groups'], $this->_tables['fuel_notification_groups'] . '.id = ' . $this->_tables['notification'] . '.group_id', 'left');
		// $this->db->order_by('release_date desc');

		$this->db->select('*');
		$this->db->get('events');
		 $this->db->order_by('release_date desc');
	}
	public function on_before_validate($values)
	{
		//  validations
		// var_dump($values);
		// die;
		if (!empty ($values['headline'])) {
			$headline = $values['headline'];
			if (!preg_match('/^[A-Za-z0-9\x{0900}-\x{097F}\-\/, ]+$/u', $headline)) {
				$this->add_error('Only alphabetical and hindi characters allowed in headline', 'headline');
				return;
			}
		}

		if(!empty($values['link'])){
			$link = $values['link'];
			if(!preg_match('/^[a-zA-Z0-9_\/-]+(?:\.[a-zA-Z0-9]{1,5})?$/', $link)) {
				$this->add_error('Only alphanumeric,slash characters and sigle dot extension allowed in link', 'link');
				return;
			}
		}

		// $isexternal = $values['isexternal'];
		// if (!in_array($isexternal, ['yes', 'no'])) {
		// 	$this->add_error('Invalid isexternal.', 'isexternal');
		// 	return;
		// }
		if (!empty($values['slug'])) {
			$slug=$values['slug'];
			if (!preg_match('/^[A-Za-z0-9-]+$/', $slug)) {
				$this->add_error('Only alphanumerical and slash characters allowed in slug', 'slug');
				return;
			}
		}
		$published = $values['published'];
		if (!in_array($published, ['yes', 'no'])) {
			$this->add_error('Invalid published.', 'published');
			return;
		}
		$release_date = $values['release_date'];
		$is_dateValid=(bool)date('Y-m-d', strtotime($release_date));
		if(!$is_dateValid){
			$this->add_error('Release date is invalid! Enter a valid date format.', 'release_date');
			return;
		}
		return $values;
	}
}

class Events_Item_model extends Base_module_record
{

	protected $_date_format = 'F d, Y';

	function get_url()
	{
		if (!empty ($this->link)) {

			if ($this->_isexternal($this->link)) {
				return $this->link;
			} else {
				return assets_path('notification/' . $this->link);
			}
		}

		return site_url('notification/' . $this->slug);
	}

	function get_excerpt_formatted($char_limit = NULL, $readmore = '')
	{
		$this->_CI->load->helper('typography');
		$this->_CI->load->helper('text');
		$excerpt = $this->content;

		if (!empty ($char_limit)) {
			// must strip tags to get accruate character count
			$excerpt = strip_tags($excerpt);
			$excerpt = character_limiter($excerpt, $char_limit);
		}
		$excerpt = auto_typography($excerpt);
		$excerpt = $this->_parse($excerpt);
		if (!empty ($readmore)) {
			$excerpt .= ' ' . anchor($this->get_url(), $readmore, 'class="readmore"');
		}
		return $excerpt;
	}

	function _isexternal($url)
	{
		$components = parse_url($url);
		return !empty ($components['host']) && strcasecmp($components['host'], $_SERVER['SERVER_NAME']);
	}

}
?>

<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once('Base_module_model.php');
class Testimonial_model extends Base_module_model
{

	public $required = array('name', 'designation', 'message', 'image');

	public $record_class = 'testimonial_item';
	//public $filters = array('published'=>'yes'); // the default list view group value for filtering
	// public $auto_validate_fields = array(
	// 	'name' => 'required',
	// 	'designation' => 'is_safe_character',
	// 	'message' => 'required',
	// 	'image' => 'valid_file_upload'
	// 	);
	function __construct()
	{
		parent::__construct('testimonial'); // table name
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'asc', $just_count = false)
	{
		$this->db->select('id, name, designation, image, published, message');
		$data = parent::list_items($limit, $offset, $col, $order);

		foreach ($data as $key => $value) {
			$data[$key]['image'] = '<img src="' . img_path('testimonial/' . $value['image']) . '" alt="" />';
		}
		return $data;
	}


	function form_fields($values = array(), $related = array())
	{
		$fields = parent::form_fields();

		$fields['image'] = array(
			'ignore_representative' => TRUE,
			'type' => 'asset',
			'multiple' => FALSE,
			'folder' => 'images/testimonial',
			'hide_options' => TRUE,
			'comment' => 'Provide a link of Image (Size: width:400px & hight:400px)'
		);


		return $fields;
	}

	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		$this->db->order_by('id');
	}

	public function on_before_validate($values)
	{
		if (!empty($values['name'])) {
			$val = $values['name'];
			if (!preg_match('/^[A-Za-z ]+$/',$val)) {
				$this->add_error('Only alphabetical characters allowed in name', 'name');
				return;
			}
		}
		if (!empty($values['designation'])) {
			$val = $values['designation'];
			// if(!is_numeric($val))
			if (!preg_match('/^[A-Za-z\-\,\. ]+$/',$val)) {
				// $this->add_error('Only numbers allowed', 'designation');
				$this->add_error('Only alphabetical characters allowed in designation', 'designation');
				return;
			}
		}

		if (!empty($values['image'])) {
			$val = $values['image'];

			if(!preg_match('/^[a-zA-Z0-9_\/-]+(?:\.[a-zA-Z0-9]{1,5})?$/', $val)) {
				$this->add_error('Only alphanumeric,slash characters and sigle dot extension allowed in image', 'image');
				return;
			}

			$temp = explode(".", $val);
			if (count($temp) != 2) {
				$this->add_error('Double extensions not allowed!', 'image');
				return;
			}
			$ext = $temp[1];
			// print_r ($ext);die;
			// echo $val;die;
			// if(!is_numeric($val))
			if ($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != 'png') {
				// $this->add_error('Only numbers allowed', 'message');
				$this->add_error('Only JPEG|JPG|GIF|PNG extensions are allowed', 'image');
				return;
			}
		}


		return $values;
	}
}

class Testimonial_item_model extends Base_module_record
{

	public function get_image_path()
	{
		return img_path('testimonial/' . $this->image);
	}
}
?>

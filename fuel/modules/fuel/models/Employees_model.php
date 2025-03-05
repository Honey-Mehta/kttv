<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once('Base_module_model.php');
class Employees_model extends Base_module_model
{

	public $required = array('name', 'publish_till', 'image');

	public $record_class = 'Employees_model_item';
	//public $filters = array('published'=>'yes'); // the default list view group value for filtering

	function __construct()
	{
		parent::__construct('employees'); // table name
		// echo 'bharat'; die;
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'publish_till', $order = 'desc', $just_count = false)
    {
    $this->db->select('id, name, designation, qualification, subject, experience, image, published, publish_till');
    $data = parent::list_items($limit, $offset, $col, $order);

    foreach ($data as $key => $value) {
        $data[$key]['image'] = '<img src="' . img_path('employeepics/' . $value['image']) . '" alt="" style="width: 100px; height: 100px;" />';
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
			'folder' => 'images/employeepics',
			'hide_options' => TRUE,
			'comment' => 'Provide a link of Image (Size: width:1600px & hight:600px)'
		);

		$fields['publish_till']['comment'] = 'A end date, To automatically disable the image';
		return $fields;
	}

	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		$this->db->order_by('publish_till desc');
	}
	public function on_before_validate($values)
	{
		// var_dump($values);die;
	

		if(!empty($values['image'])){
			$image = $values['image'];
			if(!preg_match('/^[a-zA-Z0-9_\/-]+(?:\.[a-zA-Z0-9]{1,5})?$/', $image)) {
				$this->add_error('Only alphanumeric,slash characters and sigle dot extension allowed in image', 'image');
				return;
			}
			$temp = explode(".", $image);
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

		$publish_till = $values['publish_till'];
		$is_dateValid=(bool)strtotime($publish_till);
		// if(!$is_dateValid){
		// 	$this->add_error('Publish date is invalid! Enter a valid date format.', 'publish_till');
		// 	return;
		// }
		$published=$values['published'];
		if(!in_array($published,['yes','no'])){
			$this->add_error('Invalid published.', 'published');
			return;
		}
		return $values;
	}
}


class Employees_model_item extends Base_module_record
{

	public function get_image_path()
	{
		return img_path('employeepics/' . $this->image);
	}
}
?>

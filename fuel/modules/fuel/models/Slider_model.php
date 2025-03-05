<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once('Base_module_model.php');
class Slider_model extends Base_module_model
{

	public $required = array('caption', 'publish_till', 'image');

	public $record_class = 'slider_item';
	//public $filters = array('published'=>'yes'); // the default list view group value for filtering

	function __construct()
	{
		parent::__construct('slider'); // table name
		// echo 'bharat'; die;
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'publish_till', $order = 'desc', $just_count = false)
	{
		$this->db->select('id, caption, caption_hidden, image, published, publish_till');
		$data = parent::list_items($limit, $offset, $col, $order);
		// var_dump($data); die;
		foreach ($data as $key => $value) {
			$data[$key]['image'] = '<img src="' . img_path('slider/' . $value['image']) . '" alt="" />';
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
			'folder' => 'images/slider',
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
    if (!empty($values['caption'])) {
        $caption = $values['caption'];
        if (!preg_match('/^[A-Za-z\- ]+$/', $caption)) {
            $this->add_error('Only alphabetical characters allowed in caption', 'caption');
            return;
        }
    }

    $caption_hidden = $values['caption_hidden'];
    if (!in_array($caption_hidden, ['yes', 'no'])) {
        $this->add_error('Invalid Caption hidden.', 'caption_hidden');
        return;
    }

    if (!empty($values['image'])) {
        $image = $values['image'];
        if (!preg_match('/^[a-zA-Z0-9_\/-]+(?:\.[a-zA-Z0-9]{1,5})?$/', $image)) {
            $this->add_error('Only alphanumeric, slash characters, and single dot extensions allowed in image', 'image');
            return;
        }
        $temp = explode(".", $image);
        if (count($temp) != 2) {
            $this->add_error('Double extensions not allowed!', 'image');
            return;
        }
        $ext = $temp[1];
        if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {
            $this->add_error('Only JPEG, JPG, GIF, PNG extensions are allowed', 'image');
            return;
        }
    }

    $publish_till = $values['publish_till'];
    if (!empty($publish_till)) {
        $is_dateValid = (bool) strtotime($publish_till);
        if (!$is_dateValid) {
            $this->add_error('Invalid date format for Publish Till.', 'publish_till');
            return;
        }
        $values['publish_till'] = date('Y-m-d', strtotime($publish_till)); // Format date
    }

    $published = $values['published'];
    if (!in_array($published, ['yes', 'no'])) {
        $this->add_error('Invalid published value.', 'published');
        return;
    }

    return $values;
}
}


class Slider_item_model extends Base_module_record
{

	public function get_image_path()
	{
		return img_path('slider/' . $this->image);
	}
}
?>

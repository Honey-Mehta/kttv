<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('Base_module_model.php');
class Photo_gallery_model extends Base_module_model
{

    public $required = array('name', 'image');
    public $record_class = 'Photo_gallery_model_item';

    function __construct()
    {
        parent::__construct('photo_gallery'); // table name
    }

    function list_items($limit = NULL, $offset = NULL, $col = NULL, $order = 'desc', $just_count = false)
    {
        $this->db->select('id, name, description, image, published');
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
            'comment' => 'Provide a link of Image (Size: width:1600px & height:600px)'
        );

        return $fields;
    }

    function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query();
        $this->db->order_by('id desc');
    }

    public function on_before_validate($values)
    {
        if (!empty($values['image'])) {
            $image = $values['image'];
            if (!preg_match('/^[a-zA-Z0-9_\/-]+(?:\.[a-zA-Z0-9]{1,5})?$/', $image)) {
                $this->add_error('Only alphanumeric, slash characters, and single dot extension allowed in image', 'image');
                return;
            }
            $temp = explode(".", $image);
            if (count($temp) != 2) {
                $this->add_error('Double extensions not allowed!', 'image');
                return;
            }
            $ext = $temp[1];
            if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {
                $this->add_error('Only JPEG|JPG|GIF|PNG extensions are allowed', 'image');
                return;
            }
        }

        $published = $values['published'];
        if (!in_array($published, ['yes', 'no'])) {
            $this->add_error('Invalid published.', 'published');
            return;
        }
        return $values;
    }
}

class Photogallery_model_item extends Base_module_record
{
    public function get_image_path()
    {
        return img_path('employeepics/' . $this->image);
    }
}
?>

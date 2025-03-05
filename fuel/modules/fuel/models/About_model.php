<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once('Base_module_model.php');
class About_model extends Base_module_model
{

	public $required = array('about');

	public $record_class = 'About_model_item';
	//public $filters = array('published'=>'yes'); // the default list view group value for filtering

	function __construct()
	{
		parent::__construct('about'); // table name
		// echo 'bharat'; die;
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'desc', $just_count = false)
    {
    $this->db->select('id, about, published');
    $data = parent::list_items($limit, $offset, $col, $order);

   
    
    return $data;
   }


   function form_fields($values = array(), $related = array())
   {
       $fields = parent::form_fields();

     
       return $fields;
   }

   function _common_query($display_unpublished_if_logged_in = NULL)
   {
       parent::_common_query();
       $this->db->order_by('id desc');
   }

   public function on_before_validate($values)
   {
       

       $published = $values['published'];
       if (!in_array($published, ['yes', 'no'])) {
           $this->add_error('Invalid published.', 'published');
           return;
       }
       return $values;
   }
}


class About_model_item extends Base_module_record
{


}
?>

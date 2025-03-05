<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once('Base_module_model.php');
class Vision_model extends Base_module_model
{

	public $required = array('research_and_development','revolutionary_change','concept_nationalism');

	public $record_class = 'Vision_model_item';
	//public $filters = array('published'=>'yes'); // the default list view group value for filtering

	function __construct()
	{
		parent::__construct('vision'); // table name
		// echo 'bharat'; die;
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'desc', $just_count = false)
    {
    $this->db->select('id, research_and_development, revolutionary_change, concept_nationalism, published');
    $data = parent::list_items($limit, $offset, $col, $order);

   
    
    return $data;
   }


   function form_fields($values = array(), $related = array())
   {
       $fields = parent::form_fields();

       $fields['image'] = array(
        'ignore_representative' => TRUE,
        'type' => 'asset',
        'multiple' => FALSE,
        'folder' => 'images/vision',
        'hide_options' => TRUE,
        'comment' => 'Provide a link of Image (Size: width:1600px & hight:600px)'
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
       

       $published = $values['published'];
       if (!in_array($published, ['yes', 'no'])) {
           $this->add_error('Invalid published.', 'published');
           return;
       }
       return $values;
   }
}


class Vision_model_item extends Base_module_record
{


}
?>

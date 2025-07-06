<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/Base_module_model.php');

class Contact_model extends Base_module_model
{
    public $required = ['name'];
    public $record_class = 'Contact_model_item';


    public function __construct()
    {
        parent::__construct('contact'); // Table name
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'name', $order = 'asc', $just_count = false)
    {
        $this->db->select('id, name, email, helpline_number_whatsapp_number, landline_number, office_number, location, contact_time, published');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }

    public function form_fields($values = [], $related = [])
    {
        $fields = parent::form_fields($values, $related);
        
       

        return $fields;
    }

    public  function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query($display_unpublished_if_logged_in);
        $this->db->order_by('name', 'asc');
    }
}
class Contact_model_item extends Base_module_record
{
    public function get_full_details()
    {
        return $this->name . ' (' . $this->designation . ') - ' . $this->subject;
    }
}

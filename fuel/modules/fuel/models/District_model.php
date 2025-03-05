<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/Base_module_model.php');

class District_model extends Base_module_model
{
    public $required = ['district_name','published'];
    public $record_class = 'District_model_item';


    public function __construct()
    {
        parent::__construct('district'); // Table name
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'district_name', $order = 'asc', $just_count = false)
    {
        $this->db->select('id, district_name, published');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }

    public function form_fields($values = [], $related = [])
    {
        $fields = parent::form_fields($values, $related);
        
       

        return $fields;
    }



    public function on_before_validate($values)
    {
        $fields_to_validate = ['district_name'];
    
        foreach ($fields_to_validate as $field) {
            if (!empty($values[$field])) {
                // Check for valid characters (letters and spaces only)
                if (!preg_match('/^[\p{L} ]+$/u', $values[$field])) {
                    $this->add_error(
                        ucfirst($field) . ' can only contain letters and spaces. Numbers and special characters are not allowed.',
                        $field
                    );
                }
    
                // Check for character limit (max 20 characters)
                if (mb_strlen($values[$field], 'UTF-8') > 20) {
                    $this->add_error(
                        ucfirst($field) . ' must not exceed 20 characters.',
                        $field
                    );
                }
            }
        }
    
        return $values;
    }



    public  function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query($display_unpublished_if_logged_in);
        $this->db->order_by('district_name', 'asc');
    }
}
class District_model_item extends Base_module_record
{
    public function get_full_details()
    {
        return $this->name . ' (' . $this->designation . ') - ' . $this->subject;
    }
}

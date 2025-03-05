<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/Base_module_model.php');

class Branch_model extends Base_module_model
{
    public $required = ['branch_name','published'];
    public $record_class = 'Branch_model_item';


    public function __construct()
    {
        parent::__construct('branch_name'); // Table name
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'branch_name', $order = 'asc', $just_count = false)
    {
        $this->db->select('id, branch_name, published');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }

    public function form_fields($values = [], $related = [])
    {
        $fields = parent::form_fields($values, $related);
        
       

        return $fields;
    }

    public function on_before_validate($values)
    {
        if (!empty($values['branch_name'])) {
            $branch_name = $values['branch_name'];
        
            // Ensure the branch name contains only letters, spaces, periods, and hyphens
            if (!preg_match('/^[a-zA-Z\s.-]+$/', $branch_name)) {
                $this->add_error(
                    'The branch name can only contain letters, spaces, periods, and hyphens.',
                    'branch_name'
                );
                return $values;
            }
    
            // Ensure the branch name does not exceed 30 characters
            if (mb_strlen($branch_name, 'UTF-8') > 30) {
                $this->add_error(
                    'The branch name must not exceed 30 characters.',
                    'branch_name'
                );
            }
        }
    
        return $values;
    }
    


    public  function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query($display_unpublished_if_logged_in);
        $this->db->order_by('branch_name', 'asc');
    }
}
class Branch_model_item extends Base_module_record
{
    public function get_full_details()
    {
        return $this->name . ' (' . $this->designation . ') - ' . $this->subject;
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/Base_module_model.php');

class Branch_mode_model extends Base_module_model
{
    public $required = ['branch_mode','published'];
    public $record_class = 'Branch_mode_model_item';


    public function __construct()
    {
        parent::__construct('branch_mode'); // Table name
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'branch_mode', $order = 'asc', $just_count = false)
    {
        $this->db->select('id, branch_mode, published');
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
        $this->db->order_by('branch_mode', 'asc');
    }



    public function on_before_validate($values)
    {
        if (!empty($values['branch_mode'])) {
            $branch_mode = $values['branch_mode'];
    
            // Ensure the course name does not contain '/' or '@'
            if (preg_match('/[\/@]/', $branch_mode)) {
                $this->add_error(
                    'The branch mode cannot contain "/" or "@" symbols.',
                    'branch_mode'
                );
                return $values;
            }
    
            // Ensure the course name contains only letters (uppercase and lowercase), spaces, and periods
            if (!preg_match('/^[A-Za-z\s.]+$/', $branch_mode)) {
                $this->add_error(
                    'The branch mode must contain only letters (both uppercase and lowercase), spaces, and periods.',
                    'course_name'
                );
                return $values;
            }
    
            // Ensure the course name does not exceed 20 characters
            if (mb_strlen($branch_mode, 'UTF-8') > 10) {
                $this->add_error(
                    'The branch mode must not exceed 10 characters.',
                    'course_name'
                );
            }
        }
    
        return $values;
    }













}
class Branch_mode_model_item extends Base_module_record
{
   
}

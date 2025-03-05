<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/Base_module_model.php');

class CourseLevel_model extends Base_module_model
{
    public $required = ['course_level','published'];
    public $record_class = 'CourseLevel_model_item';


    public function __construct()
    {
        parent::__construct('course_level'); // Table name
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'course_level', $order = 'asc', $just_count = false)
    {
        $this->db->select('id, course_level, published');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }

    public function form_fields($values = [], $related = [])
    {
        $fields = parent::form_fields($values, $related);
        
       

        return $fields;
    }

    public function on_before_validate($values)
{
    // Check if 'course_level' is not empty
    if (!empty($values['course_level'])) {
        // Convert the course level to uppercase
        $values['course_level'] = strtoupper($values['course_level']);

        // Check for invalid characters (allow only uppercase letters and spaces)
        if (!preg_match('/^[A-Z ]+$/', $values['course_level'])) {
            $this->add_error('Course Level can only contain uppercase letters and spaces. Numbers and special characters are not allowed.', 'course_level');
        }

        // Check for character limit (max 10 characters)
        if (mb_strlen($values['course_level'], 'UTF-8') > 10) {
            $this->add_error('Course Level must not exceed 10 characters.', 'course_level');
        }
    }

    return $values;
}

    public  function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query($display_unpublished_if_logged_in);
        $this->db->order_by('course_level', 'asc');
    }
}
class CourseLevel_model_item extends Base_module_record
{
    public function get_full_details()
    {
        return $this->name . ' (' . $this->designation . ') - ' . $this->subject;
    }
}
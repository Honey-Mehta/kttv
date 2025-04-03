<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/Base_module_model.php');

class Course_model extends Base_module_model
{
    public $required = ['course_name','course_level','published'];
    public $record_class = 'Course_model_item';


    public function __construct()
    {
        parent::__construct('course_name'); // Table name
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'course_name', $order = 'asc', $just_count = false)
    {
        $this->db->select('id, course_name, course_level, type, published');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        foreach ($data as $key => $value) {
            // Convert 'type' field to a readable format
            if (isset($value['type'])) {
                if ($value['type'] == 1) {
                    $data[$key]['type'] = 'SOS';
                } elseif ($value['type'] == 2) {
                    $data[$key]['type'] = 'Affiliated Colleges and Courses';
                }
            }
        }

        return $data;



    }

    public function form_fields($values = [], $related = [])
    {
        $fields = parent::form_fields($values, $related);


                      // Dropdown select list
    $fields['type'] = array(
        'type' => 'select',
        'label' => 'Type',
        'options' => array(
            '1' => 'SOS', 
            '2' => 'Affiliated Colleges and Courses'
        ),
        'comment' => 'Select the type of college.'
    );



        
        $query = $this->db->select('id, course_level')
        ->from('course_level') // Assuming your table is named 'course_name'
        ->get();

            $course_level_options = [];
            foreach ($query->result() as $row) {
            $course_level_options[$row->course_level] = $row->course_level; // Use 'id' as the key and 'course_name' as the value
            }


   

            // Assign dynamic options to the 'course_name' field
            $fields['course_level']['options'] = $course_level_options;
            $fields['course_level']['type'] = 'select';

   
        return $fields;
    }

    public  function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query($display_unpublished_if_logged_in);
        $this->db->order_by('course_name', 'asc');
    }



    public function on_before_validate($values)
    {
        if (!empty($values['course_name'])) {
            $course_name = $values['course_name'];
    
            // Ensure the course name does not contain '/' or '@'
            if (preg_match('/[\/@]/', $course_name)) {
                $this->add_error(
                    'The course name cannot contain "/" or "@" symbols.',
                    'course_name'
                );
                return $values;
            }
    
            // Ensure the course name contains only letters (uppercase and lowercase), spaces, and periods
            if (!preg_match('/^[A-Za-z\s.]+$/', $course_name)) {
                $this->add_error(
                    'The course name must contain only letters (both uppercase and lowercase), spaces, and periods.',
                    'course_name'
                );
                return $values;
            }
    
            // Ensure the course name does not exceed 30 characters
            if (mb_strlen($course_name, 'UTF-8') > 40) {
                $this->add_error(
                    'The course name must not exceed 40 characters.',
                    'course_name'
                );
            }
        }
    
        return $values;
    }













}
class Course_model_item extends Base_module_record
{
    public function get_full_details()
    {
        return $this->name . ' (' . $this->designation . ') - ' . $this->subject;
    }
}

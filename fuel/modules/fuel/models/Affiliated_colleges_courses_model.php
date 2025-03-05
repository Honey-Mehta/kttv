<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Base_module_model.php');
class Affiliated_colleges_courses_model extends Base_module_model {

	
	public $required = array('college_name','course_name','course_level','branch_name','district_name');

	public $record_class = 'Affiliated_colleges_courses_model_item';
	
	
	function __construct()
	{
		parent::__construct('colleges_course_list'); // table name
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'asc', $just_count = false)
	{
		$this->db->select('id, college_name, course_name, course_level, branch_name, district_name, branch_mode, published');

		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}


	function form_fields($values = array(), $related = array())
	{	
		$fields = parent::form_fields();
		
		$this->load->database();
		$query = $this->db->select('id, course_name')
						->from('course_name') // Assuming your table is named 'course_name'
						->get();

		$course_options = [];
		foreach ($query->result() as $row) {
			$course_options[$row->course_name] = $row->course_name; // Use 'id' as the key and 'course_name' as the value
		}

    // Assign dynamic options to the 'course_name' field
      $fields['course_name']['options'] = $course_options;
      $fields['course_name']['type'] = 'select';


      

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



		$query = $this->db->select('id, branch_name')
		->from('branch_name') // Assuming your table is named 'course_name'
		->get();

			$branch_options = [];
			foreach ($query->result() as $row) {
			$branch_options[$row->branch_name] = $row->branch_name; // Use 'id' as the key and 'course_name' as the value
			}

			// Assign dynamic options to the 'course_name' field
			$fields['branch_name']['options'] = $branch_options;
			$fields['branch_name']['type'] = 'select';


		$query = $this->db->select('id, district_name')
		->from('district') // Assuming your table is named 'course_name'
		->get();

			$district_options = [];
			foreach ($query->result() as $row) {
			$district_options[$row->district_name] = $row->district_name; // Use 'id' as the key and 'course_name' as the value
			}

			
			$fields['district_name']['options'] = $district_options;

             $fields['district_name']['type'] = 'select';

        
	
			 
		$query = $this->db->select('id, branch_mode')
		->from('branch_mode') // Assuming your table is named 'course_name'
		->get();

			$branch_options = [];
			foreach ($query->result() as $row) {
			$branch_options[$row->branch_mode] = $row->branch_mode; // Use 'id' as the key and 'course_name' as the value
			}

			
			$fields['branch_mode']['options'] = $branch_options;

             $fields['branch_mode']['type'] = 'select';



		return $fields;

	}

	function on_before_clean($values)
	{
		//if (empty($values['slug'])) $valuestype['slug'] = url_title($values['headline'], 'dash', TRUE);
	//	$values['created'] = datetime_now();
		//return $values;
	}


	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		$this->db->select('id, college_name, course_name, course_level, branch_name, district_name');
		$this->db->order_by('id', 'asc'); // Default order by ID ascending


	}
	public function on_before_validate($values)
	{
		if (!empty($values['college_name'])) {
            $college_name = $values['college_name'];
    
    
            // Ensure the course name does not exceed 50 characters
            if (mb_strlen($college_name, 'UTF-8') > 50) {
                $this->add_error(
                    'The college name must not exceed 50 characters.',
                    'college_name'
                );
            }
        }
		
		return $values;
	}
}

class Affiliated_colleges_courses_model_item extends Base_module_record {
	
}
?>

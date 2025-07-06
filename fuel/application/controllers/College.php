<?php
class College extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('College_model');
    }

    // public function block_data() {
    //     $data['districts'] = $this->College_model->get_districts();
    //     $this->load->view('_blocks/college_dropdown', $data);
    // }
    
    // public function dropdown() {
    //     $data['districts'] = $this->College_model->get_districts();
    //     $this->load->view('_blocks/college_dropdown_view', $data); // Load the view
    // }

     // Method to fetch districts and return as JSON
    public function get_districts() {
        $this->db->select('DISTINCT(district_name)');
        //$this->db->from('colleges_course_list');
        $this->db->from('district');
       $this->db->where('published', 'yes');
        $districts = $this->db->get()->result_array();
        if($districts)
         {
        // Return the districts as JSON
        echo json_encode($districts);
         }
         else
         {
            // echo json_encode($districts);   
            return false;
         }
    }



    public function get_colleges() {
        $district = $this->input->post('district_name');
        $colleges = $this->College_model->get_colleges_by_district($district);
        echo json_encode($colleges);
    }

    public function filter_results() {
        $district = $this->input->post('district_name');
        $college = $this->input->post('college_name');

        $results = $this->College_model->get_filtered_results($district, $college);
        echo json_encode($results);
    }


    public function get_coursesug() {
        // Load the database library if not autoloaded
      //  $this->load->database();

        // Get the course level from the AJAX request
        $course_level = $this->input->post('course_level');

        // Query to fetch distinct courses based on course level
        $this->db->distinct();
        $this->db->select('course_name');
        $this->db->where('course_level', $course_level);
        $this->db->where('published', 'yes');
        $this->db->limit(15);
       // $query = $this->db->get('colleges_course_list');
        $query = $this->db->get('course_name');

        // Return the results as JSON
        echo json_encode($query->result_array());
    }

    
    public function get_coursespg() {
        // Load the database library if not autoloaded
      //  $this->load->database();

        // Get the course level from the AJAX request
        $course_level = $this->input->post('course_level');

        // Query to fetch distinct courses based on course level
        $this->db->distinct();
        $this->db->select('course_name');
        $this->db->where('course_level', $course_level);
        $this->db->limit(15);
        //$query = $this->db->get('colleges_course_list');
        $query = $this->db->get('course_name');

        // Return the results as JSON
        echo json_encode($query->result_array());
    }
   

        
    public function get_coursespgd() {
        // Load the database library if not autoloaded
      //  $this->load->database();

        // Get the course level from the AJAX request
        $course_level = $this->input->post('course_level');

        // Query to fetch distinct courses based on course level
        $this->db->distinct();
        $this->db->select('course_name');
        $this->db->where('course_level', $course_level);
        $this->db->limit(15);
        //$query = $this->db->get('colleges_course_list');
        $query = $this->db->get('course_name');

        // Return the results as JSON
        echo json_encode($query->result_array());
    }
    
    public function set_course_session()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Pragma: no-cache");
        $this->session->set_userdata('course_name', $this->input->post('course'));
        $this->fuel->cache->clear();

    }



    public function get_notifications()
{
    $date = $this->input->get('date'); // Get date from request
    //$this->load->model('Notifications_model'); // Load the model

    if ($date) {
        // Fetch filtered notifications
        $notifications = $this->College_model->get_notifications_by_date($date);
    } else {
        // Fetch all notifications
        $notifications = $this->College_model->get_notifications();
    }

    // Return JSON response
    if ($notifications) {
        echo json_encode(['status' => 'success', 'data' => $notifications]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No notifications found.']);
    }
}


public function get_notifications_five()
{
    $date = $this->input->get('date'); // Get date from request
    //$this->load->model('Notifications_model'); // Load the model

    if ($date) {
        // Fetch filtered notifications
        $notifications = $this->College_model->get_notifications_by_date($date);
    } else {
        // Fetch all notifications
        $notifications = $this->College_model->get_notifications_latest_five();
    }

    // Return JSON response
    if ($notifications) {
        echo json_encode(['status' => 'success', 'data' => $notifications]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No notifications found.']);
    }
}



public function get_tender()
{
    $date = $this->input->get('date'); // Get date from request
    //$this->load->model('Notifications_model'); // Load the model

    if ($date) {
        // Fetch filtered notifications
        $notifications = $this->College_model->get_tender_by_date($date);
    } else {
        // Fetch all notifications
        $notifications = $this->College_model->get_tender();
    }

    // Return JSON response
    if ($notifications) {
        echo json_encode(['status' => 'success', 'data' => $notifications]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No notifications found.']);
    }
}






}
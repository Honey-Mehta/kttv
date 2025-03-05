<?php
class College_model extends CI_Model {
   

       
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
    }


    // public function get_districts() {
    //     $this->db->select('DISTINCT(district_name)');
    //     $this->db->from('colleges_course_list');
    //     return $this->db->get()->result_array();
    // }

    public function get_colleges_by_district($district) {
        $this->db->select('DISTINCT(college_name)');
        $this->db->from('colleges_course_list');
        $this->db->where('district_name', $district);
        $this->db->where('published', 'yes');
        return $this->db->get()->result_array();
    }

    public function get_filtered_results($district, $college) {
        $this->db->select('college_name, course_name, course_level, branch_name, district_name, branch_mode');
        $this->db->from('colleges_course_list');
        if ($district) $this->db->where('district_name', $district);
        if ($college) $this->db->where('college_name', $college);
        $this->db->where('published', 'yes');
        return $this->db->get()->result_array();
    }
}

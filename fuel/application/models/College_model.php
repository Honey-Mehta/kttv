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
        $this->db->where('type', '2');
        return $this->db->get()->result_array();
    }





    public function get_notifications() {
        // Adjusting the query to fetch necessary fields
        $this->db->select('release_date, headline, pdf');
        $this->db->from('notifications');
        $this->db->where('published', 'yes'); // Filter only published notifications
        $this->db->order_by('release_date', 'DESC'); // Order by descending date
        $query = $this->db->get();
    
        return $query->result_array(); // Return as an array
    }
      


    public function get_notifications_latest_five() {
        $this->db->select('release_date, headline, pdf');
        $this->db->from('notifications');
        $this->db->where('published', 'yes'); // Filter only published notifications
        $this->db->order_by('release_date', 'DESC'); // Order by latest first
        $this->db->limit(5); // Get only the latest 5 notifications
        $query = $this->db->get();
    
        return $query->result_array(); // Return as an array
    }






    public function get_notifications_by_date($date)
    {
        $this->db->select('headline, release_date, pdf'); // Select relevant columns
        $this->db->from('notifications'); // Table name
        $this->db->where('DATE(release_date)', $date); // Filter by the specific date
        $this->db->where('published', 'yes'); // Only fetch published notifications
        $this->db->order_by('release_date', 'DESC'); // Order by date
        $query = $this->db->get();
    
        return $query->result_array(); // Return results as an array
    }
    

    public function get_tender() {
        // Adjusting the query to fetch necessary fields
        $this->db->select('tender_date, name, pdf');
        $this->db->from('tender');
        $this->db->where('published', 'yes'); // Filter only published notifications
        $this->db->order_by('tender_date', 'DESC'); // Order by descending date
        $query = $this->db->get();
    
        return $query->result_array(); // Return as an array
    }


    public function get_tender_by_date($date)
    {
        $this->db->select('name, tender_date, pdf'); // Select relevant columns
        $this->db->from('tender'); // Table name
        $this->db->where('DATE(tender_date)', $date); // Filter by the specific date
        $this->db->where('published', 'yes'); // Only fetch published notifications
        $this->db->order_by('tender_date', 'DESC'); // Order by date
        $query = $this->db->get();
    
        return $query->result_array(); // Return results as an array
    }



}
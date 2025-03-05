<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Paramedical_courses extends CI_Controller {
     
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library(['form_validation','session']);
        $this->load->model('pmc_db_model');

    }
     
    function index()
    {
        // set your variables
        $vars = array(
            'page_title' => 'Search Paramedical Courses',
            'layout' => 'full_page_layout',
            'getcourses_list' => array(),
        );

        if($_POST){
            $this->form_validation->set_rules('districtID', 'District', 'trim|required|numeric|max_length[3]');        
            $this->form_validation->set_rules('courseType', 'courseType', 'trim|required|alpha_numeric|max_length[4]');        
            $this->form_validation->set_rules('courseID', 'courseType', 'trim|required|alpha_numeric|max_length[4]');        

            if ($this->form_validation->run() == TRUE)
            {
                $api_response = json_decode($this->pmc_db_model->api_request(
                            array('requestType'=>'college_search',
                            'DistrictId'=> $this->input->post('districtID', TRUE),
                            'Course_Type'=> $this->input->post('courseType',TRUE),
                            'course_code'=> $this->input->post('courseID',TRUE)
                       )
                    ));

                if($api_response[0]->status == 'ok')
                {                   
                    $list = $api_response[0]->data;
                } else {
                    $list = array();
                }
                $vars['getcourses_tbl'] = $list;
            }
        }

        

        $api_response = json_decode($this->pmc_db_model->api_request(['requestType'=>'courseType']));

        if($api_response[0]->status ?? '' == 'ok')
        {
            $json = $api_response[0]->data;
            $data[''] = '--Select--';
            foreach ($json as $row) {
                $data[$row->Course_type] = $row->Course_type_Desc;
            }
            
            $list = $data;
        } else {
            $list = array(''=> '--Select--');
        }
        $vars['getcourseType_list'] = $list;


        $api_response = json_decode($this->pmc_db_model->api_request(['requestType'=>'district_List']));

        if($api_response[0]->status ?? ''== 'ok')
        {
            $json = $api_response[0]->data;
            $district_data[''] = '--Select--';
            foreach ($json as $row) {
                $district_data[$row->DistrictId] = $row->DistrictName;
            }
            
            $list = $district_data;
        } else {
            $list = array(''=> '--Select--');
        }
        $vars['getdistrict_list'] = $list;
 
        //... form code goes here
        $this->fuel->pages->render('paramedical_courses', $vars);
    }

    function coursesList()
    {
        $this->form_validation->set_rules('courseType', 'courseType', 'trim|required|alpha_numeric|max_length[4]');        

        if ($this->form_validation->run() == TRUE)
        {
            $data = array(
                    'requestType' => 'courses_List',
                    'type' => $this->input->post('courseType', TRUE)
                );
            $api_response = json_decode($this->pmc_db_model->api_request($data));

            if($api_response[0]->status == 'ok')
            {
                echo '['. json_encode(array('status'=>'success','options'=> $api_response[0]->data)) .']';
            } else {
                echo '['. json_encode(array('status'=>'failed','options'=>'unable to fetch api')). ']';
            }
            
            
        } else {
            echo '['. json_encode(array('status'=>'failed','options'=>null)). ']';
        }

    }

}

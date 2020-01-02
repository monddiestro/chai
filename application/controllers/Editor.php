<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Editor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->check_session();
    }

    // check session and 
    function check_session() {
        if(!$this->session->has_userdata('user_id')) {
             // create flash data session for notification
            $result_data = array(
                'class' => "warning",
                'message' => "<strong>Oops!</strong> Your session expired. Please login again."
            );
            // store temporary session
          $this->session->set_flashdata('result',$result_data);
            redirect(base_url());
        }
    }

    function index() {
        
        // pass data to header view
        $head["nav"] = "dashboard";

        // data for dashboard
        // $data["member_cnt"] = $this->member_model->pull_member_cnt();
        // $data["unit_cnt"] = $this->unit_model->pull_unit_cnt();
        // $data["car_cnt"] = $this->car_model->pull_car_cnt();
        // $data["pending"] = $this->request_model->pull_request_details("pending");
        // $data["helpers"] = $this->request_model->pull_helpers();
        // $data["log"] = $this->activity_model->pull_activity();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('dashboard-editor');
        $this->load->view('modal');
        $this->load->view('footer');

    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
    // constructor
    public function __construct() {
        parent::__construct();
        //load all models need first
        $this->load->model('unit_model');
        $this->load->model('member_model');
        $this->load->model('car_model');
        $this->load->model('work_model');
        $this->load->model('helper_model');
        $this->load->model('pet_model');
        $this->load->model('account_model');
        $this->load->model('activity_model');
        $this->load->model('request_model');
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
        // pull units with owner
        $data["units"] = $this->unit_model->pull_units();
        // pull all members
        $data["members"] = $this->member_model->pull_members('','');
        // set homepage query to empty
        $data["q_member"] = "";
        $data["q_name"] = "";
        // create json file
        $json["members"] = $this->generateJSON($this->member_model->pull_members('',''));
        // pull all cars
        $data["cars"] = $this->car_model->pull_car('');


        // pull all logs
        $data["log"] = $this->activity_model->pull_activity();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('user-view',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);

    }

    // search function
    function q() {

        // member id query
        $member_id = $this->uri->segment(3);
        
        // pass data to header view
        $head["nav"] = "dashboard";

        // data for dashboard
        // pull units with owner
        $data["units"] = $this->unit_model->pull_units();
        // pull all members
        $data["members"] = $this->member_model->pull_members('',$member_id);
        // set homepage query to empty
        $data["q_member"] = $member_id;
        $data["q_name"] = $this->member_model->pull_name($member_id);
        // create json file
        $json["members"] = $this->generateJSON($this->member_model->pull_members('',''));
        // pull all cars
        $data["cars"] = $this->car_model->pull_car('');


        // pull all logs
        $data["log"] = $this->activity_model->pull_activity();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('user-view',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);
        
    }

    // create json array for auto suggest
    function generateJSON($members) {
        $data = array();
        foreach ($members as $m) {
            $data[] = array(
                'label' => $m->f_name . " " . $m->l_name,
                'value' => $m->f_name . " " . $m->l_name,
                'member_id' => $m->member_id
            );
        }
        return json_encode($data,TRUE);
    }

}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Logs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->load->model('account_model');
        $this->load->model('activity_model');
    }

    function index() {
        // pass data to header view
        $head["nav"] = "";
        // check session if user still using the system
        $this->check_session();

        // pull all activities from model
        $data["activity"] = $this->activity_model->pull_activity();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('logs',$data);
        $this->load->view('modal');
        $this->load->view('footer');
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

    
}

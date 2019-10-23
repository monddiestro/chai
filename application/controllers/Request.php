<?php
class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->check_session();
        $this->load->model('unit_model');
        $this->load->model('work_model');
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
        $head["nav"] = "inbox";

        // data for dashboard
        $data["units"] = $this->unit_model->pull_units();
        $data["works"] = $this->work_model->pull_work("");

 
        // $this->load->view('head',$head);
        // $this->load->view('sidebar');
        // $this->load->view('top-bar');
        // $this->load->view('request',$data);
        // $this->load->view('modal');
        // $this->load->view('footer');
    }

    // API
    function pull_available_helpers() {
        $work_id = 2;//$this->input->post('work_id');
        // pull helpers with same work and available
        $helpers = $this->work_model->pull_helpers($work_id);
        //var_dump($helpers);
    }


}

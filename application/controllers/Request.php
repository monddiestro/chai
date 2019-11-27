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
        $this->load->model('request_model');
        $this->load->model('helper_model');
        $this->load->model('activity_model');
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
        $data["requests"] = $this->request_model->pull_request("",'in-progress');
        $data["helpers"] = $this->request_model->pull_helpers();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('request',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    function new() {
        $referer = $this->input->server('HTTP_REFERER');
        $work_id = $this->input->post('work_id');
        $helper_id = $this->input->post('helper_id');
        $unit_id = $this->input->post('unit_id');
        $request_desc =$this->input->post('request_desc');
        $date_request = $this->input->post('date_request');

        // if helper status is empty
        // status = pending
        // if helper is not empty 
        // status = in-progress
        $status = empty($helper_id) ? 'pending' : 'in-progress';
        $user_id = $this->session->userdata('user_id');
        $date_created = date('Y-m-d H:m:s');
        // create data array
        $data = array(
            'unit_id' => $unit_id,
            'work_id' => $work_id,
            'request_desc' => $request_desc,
            'helper_id' => $helper_id,
            'status' => $status,
            'user_id' => $user_id,
            'date_created' => $date_created,
            'date_request' => $date_request
        );
        // push data to model
        $this->request_model->push_request($data);

        // update helper status set to not available
        if(!empty($helper_id)) {
            $this->helper_model->push_update(array('status' => 'not available'),$helper_id);
        }
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> New request created"
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        $unit_number = $this->unit_model->pull_unit_number($unit_id);

        // push activity
        $this->push_activity('New request created for unit '.$unit_number);

        // redirect page to referer
        redirect($referer);

    }

    function change_status() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $status = $this->input->post('status');
        $request_id = $this->input->post('request_id');
        $helper_id = $this->input->post('helper_id');
        $data = array();
        // check what update to change status of agent
        if($status == "done") {
            // pass the data to model for update
            $data = array('status' => $status);
            $this->helper_model->push_update(array('status' => 'available'),$helper_id);
            $this->push_activity('Change status of request id:'.$request_id." to done");
        } else {
            $data = array('status' => $status, 'helper_id' => $helper_id);
            $this->helper_model->push_update(array('status' => 'not available'),$helper_id);
            $this->push_activity('Change status of request id:'.$request_id." to in-progress");
        }
        $this->request_model->push_update($data,$request_id);
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> Request status changed"
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);


        // redirect page to referer
        redirect($referer);

    }

    function archive() {

        // pass data to header view
        $head["nav"] = "archive";

        // data for dashboard
        $data["requests"] = $this->request_model->pull_request_details('done');
        $data["helpers"] = $this->request_model->pull_helpers();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('archive',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    
    // API
    function pull_available_helpers() {
        $work_id = $this->input->post('work_id');
        // pull helpers with same work and available
        $helpers = $this->work_model->pull_helpers($work_id);
        foreach($helpers as $h) {
            echo '<option value="'.$h->helper_id.'">'.$h->f_name. " ".$h->l_name.'</option>';
        }
    }


    function push_activity($activity) {
        // insert activity
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'act_desc' => $activity,
            'date_created' => date("Y-m-d H:i:s")
        );
        // insert activity pass array to model
        $this->activity_model->push_activity($data);
    }


}

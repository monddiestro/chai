<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Editor extends CI_Controller
{
    public function __construct()
    {
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
        $data["member_cnt"] = $this->member_model->pull_member_cnt();
        $data["unit_cnt"] = $this->unit_model->pull_unit_cnt();
        $data["car_cnt"] = $this->car_model->pull_car_cnt();
        $data["pending"] = $this->request_model->pull_request_details("pending");
        $data["helpers"] = $this->request_model->pull_helpers();
        $data["log"] = $this->activity_model->pull_activity();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('dashboard',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    function units() {

        // pass data to header view
        $head["nav"] = "units";

        // call units model and get the data and pass it to units view
        $data["units"]= $this->unit_model->pull_units();

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('units',$data);
        $this->load->view('modal');
        $this->load->view('footer');
        
    }

    function members() {
        $unit_id = $this->uri->segment(3);

        // pass data to header view
        $head["nav"] = "members";

        // pull data from members_tbl using model
        $data["members"] = $this->member_model->pull_members($unit_id);
        $data["units"] = $this->unit_model->pull_units();
        
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('members',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    function cars() {
        // pass data to header view
        $head["nav"] = "cars";

        // pull data from members_tbl using model
        $data["units"] = $this->unit_model->pull_units();
        $data["cars"] = $this->car_model->pull_car("");
        $data["members"] = $this->member_model->pull_members('');

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('cars',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    function pets() {
        // pass data to header view
        $head["nav"] = "pets";

        // data for view
        $data["types"] = $this->pet_model->pull_type("");
        $data["units"] = $this->unit_model->pull_units();
        $data["pets"] = $this->pet_model->pull_pet();

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('pets',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    function helpers() {
        // pass data to header view
        $head["nav"] = "helpers";

        // pull works from db
        $data["works"] = $this->work_model->pull_work("");

        // pull helpers from db
        $data["helpers"] = $this->helper_model->pull_data("");

        // pull works 
        $data["helpers_work"] = $this->helper_model->pull_helper_work("");

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('helpers',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    function helpers_work() {
        // pass data to header view
        $head["nav"] = "settings";

        // pull works from db
        $data["works"] = $this->work_model->pull_work("");

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('helpers_work',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    // view for pet types
    function pet_types() {
        // pass data to header view
        $head["nav"] = "settings";

        // data for view
        $data["types"] = $this->pet_model->pull_type("");
        $data["pets"] = $this->pet_model->pull_pet();

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('pet-types',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }


}

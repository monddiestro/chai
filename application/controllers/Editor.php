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
        $data["log"] = $this->activity_model->pull_activity(10,0);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('dashboard',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    function units() {

        // delimit query
        $limit = 20;
        $offset = 0;

        // pass data to header view
        $head["nav"] = "units";

        // call units model and get the data and pass it to units view
        $data["units"]= $this->unit_model->pull_units("",$limit,$offset);

        // create json file 
        $data["units_list"] = $this->generateUnitJSON($this->unit_model->pull_units("","",$offset));

        // set homepage query to empty
        $data["q_unit"] = "";
        $data["q_number"] = "";

        // create pagination
        $units_cnt = $this->unit_model->pull_unit_cnt();
        $pagination_config = $this->units_pagination($units_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('units',$data);
        $this->load->view('modal');
        $this->load->view('footer');
        
    }

    // create json file
    function generateUnitJSON($units) {
        $data = array();
        foreach ($units as $u) {
            $data[] = array(
                'label' => $u->number,
                'value' => $u->number,
                'unit_id' => $u->unit_id
            );
        }
        return json_encode($data,TRUE);
    }

    // units page
    function units_page() {
        // page number
        $page = $this->uri->segment(3);
        $page = empty($page) ? 0 : $page - 1;

        // delimit query
        $limit = 20;
        $offset = empty($page) ? 0 : 20 * $page;

        // pass data to header view
        $head["nav"] = "units";

        // call units model and get the data and pass it to units view
        $data["units"]= $this->unit_model->pull_units("",$limit,$offset);
        // set homepage query to empty
        $data["q_unit"] = "";
        $data["q_number"] = "";
        // create json file 
        $data["units_list"] = $this->generateUnitJSON($this->unit_model->pull_units("","",$offset));
        // create pagination
        $units_cnt = $this->unit_model->pull_unit_cnt();
        $pagination_config = $this->units_pagination($units_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('units',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }



    // units pagination config
    function units_pagination($units_cnt) {
        $config["base_url"] = base_url('editor/units_page/');
        $config["total_rows"] = $units_cnt;
        $config["per_page"] = 20;
        $config['num_links'] = 1;
        $config['attributes'] = array('class' => 'page-link');
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        return $config;
    }

    // query units
    function unit_q() {

        $q_unit = $this->uri->segment(3);

        // pass data to header view
        $head["nav"] = "units";

        // call units model and get the data and pass it to units view
        $data["units"]= $this->unit_model->pull_units($q_unit,"","");
        // set homepage query to empty
        $data["q_unit"] = $q_unit;
        $data["q_number"] = $this->unit_model->pull_unit_number($q_unit);
        // create json file 
        $data["units_list"] = $this->generateUnitJSON($this->unit_model->pull_units("","",""));
        

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('units',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    function members() {
        // pass data to header view
        $head["nav"] = "members";
        
        // pull data from members_tbl using model
        $data["members"] = $this->member_model->pull_members('','',0,20);
        $data["units"] = $this->unit_model->pull_units("","","");
        // create json file
        $json["members"] = $this->generateMemberJSON($this->member_model->pull_members('','','',''));
        // create pagination
        $members_cnt = $this->member_model->pull_member_cnt();
        $pagination_config = $this->members_pagination($members_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);


        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('members',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);
    }

    function members_page() {
        // page number
        $page = $this->uri->segment(3);
        $page = empty($page) ? 0 : $page - 1;

        // delimit query
        $limit = 20;
        $offset = empty($page) ? 0 : 20 * $page;

        // pass data to header view
        $head["nav"] = "members";

        $data["members"] = $this->member_model->pull_members('','',$offset,$limit);
        $data["units"] = $this->unit_model->pull_units("","","");
        // create json file
        $json["members"] = $this->generateMemberJSON($this->member_model->pull_members('','','',''));
        // create pagination
        $members_cnt = $this->member_model->pull_member_cnt();
        $pagination_config = $this->members_pagination($members_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('members',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);

    }

    // function for members search
    function members_q() {
        $member_id = $this->uri->segment(3);

        // pass data to header view
        $head["nav"] = "members";

        // pull data from members_tbl using model
        $data["members"] = $this->member_model->pull_members("",$member_id,"","");
        $data["units"] = $this->unit_model->pull_units("","","");

        // search value 
        $data["member_name"] = $this->member_model->pull_member_name($member_id);
        $data["member_id"] = $member_id;


        // create json file
        $json["members"] = $this->generateMemberJSON($this->member_model->pull_members('','',"",""));
        
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('members',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);
    }

    // generate members JSON
    function generateMemberJSON($members) {
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

    // members pagination config

    function members_pagination($members_cnt) {
        $config["base_url"] = base_url('editor/members_page/');
        $config["total_rows"] = $members_cnt;
        $config["per_page"] = 20;
        $config['num_links'] = 1;
        $config['attributes'] = array('class' => 'page-link');
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        return $config;
    }

    function cars() {
        // pass data to header view
        $head["nav"] = "cars";

        // pull data from members_tbl using model
        $data["units"] = $this->unit_model->pull_units("","","");
        $data["cars"] = $this->car_model->pull_car("",20,0,"");
        $data["members"] = $this->member_model->pull_members('','',"","","");

        $script["members"] = "";
        // create json file
        $script["car_list"] = $this->generateCarJSON($this->car_model->pull_car("","","","",""));

        // create pagination
        $cars_cnt = $this->car_model->pull_car_cnt();
        $pagination_config = $this->cars_pagination($cars_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);
        
        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('cars',$data);
        $this->load->view('modal');
        $this->load->view('footer',$script);
    }

    // cars pagination view
    function cars_page() {

        $page = $this->uri->segment(3);

        $page = empty($page) ? 0 : $page - 1;

        // delimit query
        $limit = 20;
        $offset = empty($page) ? 0 : 20 * $page;

        // pass data to header view
        $head["nav"] = "cars";

        // pull data from members_tbl using model
        $data["units"] = $this->unit_model->pull_units("","","");
        $data["cars"] = $this->car_model->pull_car("",$limit,$offset,"");
        $data["members"] = $this->member_model->pull_members('','',"","");

        // script data
        $script["members"] = "";
        // create json file
        $script["car_list"] = $this->generateCarJSON($this->car_model->pull_car("","","","",""));

        // create pagination
        $cars_cnt = $this->car_model->pull_car_cnt();
        $pagination_config = $this->cars_pagination($cars_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);
        
        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('cars',$data);
        $this->load->view('modal');
        $this->load->view('footer',$script);
        

    }

    function car_q() {
        // car_id
        $car_id = $this->uri->segment(3);

        // pass data to header view
        $head["nav"] = "cars";

        // pull data from members_tbl using model
        $data["units"] = $this->unit_model->pull_units("","","");
        $data["cars"] = $this->car_model->pull_car("","","",$car_id);
        $data["members"] = $this->member_model->pull_members('','',"","");
        $data["car_name"] = $this->car_model->pull_car_name($car_id);
        $data["car_id"] = $car_id;

        // script data
        $script["members"] = "";
        // create json file
        $script["car_list"] = $this->generateCarJSON($this->car_model->pull_car("","","",""));

        
        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('cars',$data);
        $this->load->view('modal');
        $this->load->view('footer',$script);

    }

    // cars pagination
    function cars_pagination($cars_cnt) {
        $config["base_url"] = base_url('editor/cars_page/');
        $config["total_rows"] = $cars_cnt;
        $config["per_page"] = 20;
        $config['num_links'] = 1;
        $config['attributes'] = array('class' => 'page-link');
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        return $config;
    }

    // generate members JSON
    function generateCarJSON($cars) {
        $data = array();
        foreach ($cars as $c) {
            $data[] = array(
                'label' => $c->make . " " . $c->model . "(" . $c->plate_number.")",
                'value' => $c->make . " " . $c->model . "(" . $c->plate_number.")",
                'car_id' => $c->id
            );
        }
        return json_encode($data,TRUE);
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
       $data["helpers"] = $this->helper_model->pull_data("",20,0);

       // pull works 
       $data["helpers_work"] = $this->helper_model->pull_helper_work("");
       
       // generate data for search
       // create json file
       $json["helpers_list"] = $this->generateHelperJSON($this->helper_model->pull_data("","",""));

       // pagination
       $helpers_cnt = $this->helper_model->pull_helper_cnt();
       $pagination_config = $this->helpers_pagination($helpers_cnt);
       $data["pagination"] = $this->generate_pagination($pagination_config);

       // views
       $this->load->view('head',$head);
       $this->load->view('sidebar');
       $this->load->view('top-bar');
       $this->load->view('helpers',$data);
       $this->load->view('modal');
       $this->load->view('footer',$json);
    }

    // helper search
    function helpers_q() {
        // helper id
        $helper_id = $this->uri->segment(3);

        // pass data to header view
        $head["nav"] = "helpers";

        // pull works from db
        $data["works"] = $this->work_model->pull_work("");

        // pull helpers from db
        $data["helpers"] = $this->helper_model->pull_data($helper_id,"","");
        // search data
        $data["helper_name"] = $this->helper_model->pull_name($helper_id);
        $data["helper_id"] = $helper_id;

        // pull works 
        $data["helpers_work"] = $this->helper_model->pull_helper_work("");
        
        // generate data for search
        // create json file
        $json["helpers_list"] = $this->generateHelperJSON($this->helper_model->pull_data("","",""));

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('helpers',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);
    }

    function helpers_page() {

        // page number
        $page = $this->uri->segment(3);
        $page = empty($page) ? 0 : $page - 1;

        // delimit query
        $limit = 20;
        $offset = empty($page) ? 0 : 20 * $page;

        // pass data to header view
        $head["nav"] = "helpers";

        // pull works from db
        $data["works"] = $this->work_model->pull_work("");

        // pull helpers from db
        $data["helpers"] = $this->helper_model->pull_data("",$limit,$offset);

        // pull works 
        $data["helpers_work"] = $this->helper_model->pull_helper_work("");
        
        // generate data for search
        // create json file
        $json["helpers_list"] = $this->generateHelperJSON($this->helper_model->pull_data("","",""));

        // create pagination
        $helpers_cnt = $this->helper_model->pull_helper_cnt();
        $pagination_config = $this->helpers_pagination($helpers_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('helpers',$data);
        $this->load->view('modal');
        $this->load->view('footer',$json);

    }

    function helpers_pagination($helpers_cnt) {
        $config["base_url"] = base_url('editor/helpers_page/');
        $config["total_rows"] = $helpers_cnt;
        $config["per_page"] = 20;
        $config['num_links'] = 1;
        $config['attributes'] = array('class' => 'page-link');
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        return $config;
    }

    // generate members JSON
    function generateHelperJSON($helpers) {
        $data = array();
        foreach ($helpers as $h) {
            $data[] = array(
                'label' => $h->f_name . " " . $h->l_name,
                'value' => $h->f_name . " " . $h->l_name,
                'helper_id' => $h->helper_id
            );
        }
        return json_encode($data,TRUE);
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

    // create units pagination
    function generate_pagination($config) {
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }


}

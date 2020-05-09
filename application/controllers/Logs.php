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
        $this->load->model('unit_model');
    }

    function index() {
        // pass data to header view
        $head["nav"] = "logs";
        // check session if user still using the system
        $this->check_session();

        // pull all activities from model
        $data["activity"] = $this->activity_model->pull_activity(20,0);

        // units
        $data["units"] = $this->unit_model->pull_units("","",0);

        // create pagination
        $activity_cnt = $this->activity_model->pull_activity_cnt();
        $pagination_config = $this->activity_pagination($activity_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);
        

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('logs',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    function page() {
        // page number
        $page = $this->uri->segment(3);
        $page = empty($page) ? 0 : $page - 1;

        // delimit query
        $limit = 20;
        $offset = empty($page) ? 0 : 20 * $page;

        // pass data to header view
        $head["nav"] = "logs";
        // check session if user still using the system
        $this->check_session();

        // pull all activities from model
        $data["activity"] = $this->activity_model->pull_activity($limit,$offset);

        // create pagination
        $activity_cnt = $this->activity_model->pull_activity_cnt();
        $pagination_config = $this->activity_pagination($activity_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('logs',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    // activity pagination
    function activity_pagination($activity_cnt) {
        $config["base_url"] = base_url('logs/page/');
        $config["total_rows"] = $activity_cnt;
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

    // create pagination for config
    function generate_pagination($config) {
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    // visitors log
    function visitors() {
        // pass data to header view
        $head["nav"] = "logs";
        // check session if user still using the system
        $this->check_session();
        
        // website data
        $data["visitors"] = $this->activity_model->pull_visitors(20,0,"");
        $data["units"] = $this->unit_model->pull_units("","","");
        // autocomplete data
        $script["visitors_list"] = $this->generateVisitorJSON($this->activity_model->pull_visitors("","",""));

        // create pagination
        $visitors_cnt = $this->activity_model->pull_visitors_cnt();
        $pagination_config = $this->visitors_pagination($visitors_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('logs-visitor',$data);
        $this->load->view('modal',$script);
        $this->load->view('footer');
    }

    // visitors page
    function visitors_page() {
        // page number
        $page = $this->uri->segment(3);
        $page = empty($page) ? 0 : $page - 1;

        // delimit query
        $limit = 20;
        $offset = empty($page) ? 0 : 20 * $page;

        // pass data to header view
        $head["nav"] = "logs";
        // check session if user still using the system
        $this->check_session();
        
        // website data
        $data["visitors"] = $this->activity_model->pull_visitors($limit,$offset,"");
        $data["units"] = $this->unit_model->pull_units("","","");
        // autocomplete data
        $script["visitors_list"] = $this->generateVisitorJSON($this->activity_model->pull_visitors("","",""));

        // create pagination
        $visitors_cnt = $this->activity_model->pull_visitors_cnt();
        $pagination_config = $this->visitors_pagination($visitors_cnt);
        $data["pagination"] = $this->generate_pagination($pagination_config);

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('logs-visitor',$data);
        $this->load->view('modal',$script);
        $this->load->view('footer');
    }

    // search visitor
    function visitor_q() {
        $visitor_id = $this->uri->segment(3);
        // pass data to header view
        $head["nav"] = "logs";
        // check session if user still using the system
        $this->check_session();
        // search data
        $data["visitor_name"] = $this->activity_model->pull_visitor_name($visitor_id);
        $data["visitor_id"] = $visitor_id;
        // website data
        $data["visitors"] = $this->activity_model->pull_visitors("","",$visitor_id);
        $data["units"] = $this->unit_model->pull_units("","","");
        // autocomplete data
        $script["visitors_list"] = $this->generateVisitorJSON($this->activity_model->pull_visitors("","",""));


        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('logs-visitor',$data);
        $this->load->view('modal',$script);
        $this->load->view('footer');
    }

    // visitors pagination config
    function visitors_pagination($visitors_cnt) {
        $config["base_url"] = base_url('logs/visitors_page/');
        $config["total_rows"] = $visitors_cnt;
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

    function visitor_out() {
        // referal link
        $referal = $this->input->server('HTTP_REFERER');

        $visitor_id = $this->input->post('visitor_id');
        $this->activity_model->push_exit($visitor_id);

        // push activity
        $this->push_activity('Add exit date time to visitor: '.$visitor_id);

        // create session result
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> Visitor data was successfully updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        redirect($referal);

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
    
    // generate json for autocomplete
    // create json file
    function generateVisitorJSON($visitors) {
        $data = array();
        foreach ($visitors as $v) {
            $data[] = array(
                'label' => $v->first_name . " " . $v->last_name,
                'value' => $v->first_name . " " . $v->last_name,
                'visitor_id' => $v->visitor_id
            );
        }
        return json_encode($data,TRUE);
    }

    

    
}

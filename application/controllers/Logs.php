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
        $head["nav"] = "logs";
        // check session if user still using the system
        $this->check_session();

        // pull all activities from model
        $data["activity"] = $this->activity_model->pull_activity(20,0);

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


    
}

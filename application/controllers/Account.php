<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->load->model('account_model');
        $this->load->model('activity_model');
    }

    function index() {
        if($this->session->has_userdata('user_id')) {
            $this->uac_view($this->session->userdata('uac')); 
        } else {
            $this->load->view('login');
        }
    }

    function check_user() {
        $referer = $this->input->server('HTTP_REFERER');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $uac = "";
        // check username if exist in db
        $result = $this->account_model->pull_username($username);

        if($result != 0) {
            $userdata = $this->account_model->pull_user($username,$password);
            if(!empty($userdata)) {
                $user_data = array();
                foreach($userdata as $u) {
                    $user_data = array(
                        'user_id' => $u->user_id,
                        'f_name' => $u->f_name,
                        'l_name' => $u->l_name,
                        'uac' => $u->uac,
                        'image' => $u->image
                    );
                    $uac = $u->uac;
                    // create data array for activity
                    $act_data = array(
                        'user_id' => $u->user_id,
                        'act_desc' => 'sign in to website',
                        'date_created' => date('Y-m-d H:i:s')
                    );
                }
                // insert activity pass array to model
                $this->activity_model->push_activity($act_data);
                $this->session->set_userdata($user_data);
                // load view
                $this->uac_view($uac);
            } else {
                $this->error_message("<strong>Oops!</strong> Invalid Password.");
                redirect($referer);
            }
        } else {
            $this->error_message("<strong>Oops!</strong> Invalid Username.");
            redirect($referer);
        }
    }

    function error_message($message) {
        // create flash data session for notification
        $result_data = array(
          'class' => "danger",
          'message' => $message
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
    }

    function uac_view($uac) {
        if($uac == "administrator") {
            redirect(base_url('admin'));
        } elseif($uac == "editor") {
            redirect(base_url('editor'));
        } elseif($uac == "user") {
            redirect(base_url('user'));
        } else {
            $this->load->view('login');
        }
    }

    function signout() {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'act_desc' => 'sign out to website',
            'date_created' => date("Y-m-d H:i:s")
        );
        // insert activity pass array to model
        $this->activity_model->push_activity($data);
        $this->session->sess_destroy();
        redirect(base_url());
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

    function profile() {
        // pass data to header view
        $head["nav"] = "";
        // check session if user still using the system
        $this->check_session();

        // pull account data
        $data["account_info"] = $this->account_model->pull_account($this->session->userdata('user_id'));


        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('profile',$data);
        $this->load->view('modal');
        $this->load->view('footer');
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->load->model('unit_model');
        $this->load->model('member_model');
    }
    

	function index() {
        $this->load->view('head');
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('content');
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

    function new_unit() {
        // users referer link for redirection
        $referer = $this->input->server('HTTP_REFERER');
        // posted data
        $number = $this->input->post('number');
        $type = $this->input->post('type');
        $address = $this->input->post('address');
        // data array submit to model
        $data = array(
            'number' => $number,
            'type' => $type,
            'address' => $address
        );
        // call model and pass data
        $this->unit_model->push_unit($data);
        // create flash data session for notification
        $result_data = array(
          'class' => "success",
          'message' => "<strong>Success!</strong> New unit saved to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);

    }

    function update_unit() {
        // users referer link for redirection
        $referer = $this->input->server('HTTP_REFERER');
        // posted data
        $id = $this->input->post('id');
        $number = $this->input->post('number');
        $type = $this->input->post('type');
        $address = $this->input->post('address');
        // data array submit to model
        $data = array(
            'number' => $number,
            'type' => $type,
            'address' => $address,
            'date_created' => date('Y-m-d H:i:s')
        );
        // call model and pass data
        $this->unit_model->push_update($data,$id);
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> Unit data has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);

    }

    function new_member() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $type = $this->input->post('type');
        $l_name = $this->input->post('l_name');
        $f_name = $this->input->post('f_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $unit_id = $this->input->post('unit_id');
        $image = "";
    
        // upload image
        $config["upload_path"] = './img/'; // directory for uploads
        $config['allowed_types'] = 'gif|jpg|png'; // file types
        $this->load->library('upload', $config); // load library
        if($this->upload->do_upload('user_image')) { // attempt to upload
            // if success set the file directory
            $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
        }

        // create data array and pass to model
        $data = array(
            'l_name' => $l_name,
            'f_name' => $f_name,
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'unit_id' => $unit_id,
            'date_created' = date('Y-m-d H:i:s'),
            'type' => $type,
            'image' => $image
        );
        // call model and pass data
        $this->member_model->push_member($data);
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $f_name . " " . $l_name . " has been added to members database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);

    }
}

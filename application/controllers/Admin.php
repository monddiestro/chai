<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->load->model('unit_model');
        $this->load->model('member_model');
        $this->load->model('car_model');
        $this->load->model('work_model');
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
        $data["pending"] = "";

        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('dashboard',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    // function to view units 
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
    // function on creating new unit
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
    // function to update unit details
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
    // function to view members
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
    // function to create new members
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
            'date_created' => date('Y-m-d H:i:s'),
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

    // function to update member
    function update_member() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $member_id = $this->input->post('member_id');
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

        if(!empty($_FILES["user_image"]["name"])) {
            if($this->upload->do_upload('user_image')){

                // check first if image dir is not empty delete the old file
                $old_image = $this->member_model->pull_member_image($member_id);
                // new image 
                // if success set the file directory
                $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
                $data = array(
                    'image' => $image
                );
                $this->member_model->push_update($data,$member_id);
                // delete old
                if(!empty($old_image)) {
                    unlink("./".$old_image);
                }
            }
        }

        // update other details 
        $data = array (
            'l_name' => $l_name,
            'f_name' => $f_name,
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'unit_id' => $unit_id,
            'type' => $type,
        );

        // call model and pass data
        $this->member_model->push_update($data,$member_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $f_name . " " . $l_name . " details has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);

    }

    // function to remove member records
    function drop_member() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $member_id = $this->input->post('member_id');
        $member_name = $this->input->post('member_name');

        // get image url to remove also the photo
        $old_image = $this->member_model->pull_member_image($member_id);
        // delete the file
        if(!empty($old_image)) {
            unlink("./".$old_image);
        }
        // call model to drop member
        $this->member_model->drop_member($member_id);
        
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $member_name .  " has been removed from database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);
    }
    // cars view
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

    // create new car entry
    function add_car() {
        $referer = $this->input->server('HTTP_REFERER');
        $make = $this->input->post('make');
        $model = $this->input->post('model');
        $color = $this->input->post('color');
        $plate_number = $this->input->post('plate_no');
        $member_id = $this->input->post('member_id');
        $unit_id = $this->input->post('unit_id');
        $image = "";

        // upload image
        $config["upload_path"] = './img/'; // directory for uploads
        $config['allowed_types'] = 'gif|jpg|png'; // file types
        $this->load->library('upload', $config); // load library
        if($this->upload->do_upload('car_image')) { // attempt to upload
            // if success set the file directory
            $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
        }
        // create data array
        $data = array(
            'make' => $make,
            'model' => $model,
            'color' => $color,
            'plate_number' => $plate_number,
            'member_id' => $member_id,
            'unit_id' => $unit_id,
            'image' => $image,
            'date_created' => date('Y-m-d H:i:s')
        );
        // push data to db
        $this->car_model->push_car($data);
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $make . " " . $model . " " . $plate_number .  " has been added to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);
    }

    // function to modify car details
    function modify_car() {
        $referer = $this->input->server('HTTP_REFERER');
        $car_id = $this->input->post('car_id');
        $image = "";
        $unit_id = $this->input->post('unit_id');
        $member_id = $this->input->post('member_id');
        $make = $this->input->post('make');
        $model = $this->input->post('model');
        $color = $this->input->post('color');
        $plate_number = $this->input->post('plate_no');

        // upload image
        $config["upload_path"] = './img/'; // directory for uploads
        $config['allowed_types'] = 'gif|jpg|png'; // file types
        $this->load->library('upload', $config); // load library

        if(!empty($_FILES["car_image"]["name"])) {
            if($this->upload->do_upload('car_image')){

                // check first if image dir is not empty delete the old file
                $old_image = $this->car_model->pull_car_image($car_id);
                // new image 
                // if success set the file directory
                $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
                $data = array(
                    'image' => $image
                );
                $this->car_model->push_update($data,$car_id);
                // delete old
                if(!empty($old_image)) {
                    unlink("./".$old_image);
                }
            }
        }
        // data array to update columns
        $data = array(
            'unit_id' => $unit_id,
            'member_id' => $member_id,
            'make' => $make,
            'model' => $model,
            'color' => $color,
            'plate_number' => $plate_number
        );

        // push data to update
        $this->car_model->push_update($data,$car_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $make . " " . $model . " " . $plate_number .  " has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);

    }

    // view for the helpers work registered
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

    //  create new work
    function new_work() {
        // referer of post data
        $referer = $this->input->server('HTTP_REFERER');
        // post data
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        // data array
        $data = array(
            'work_title' => $title,
            'work_desc' => $description
        );

        // pass data to model
        $this->work_model->push_work($data);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$title." added to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);

    }

    // update the work information
    function update_work() {
        // post referer
        $referer = $this->input->server('HTTP_REFERER');
        // post data
        $work_id = $this->input->post('work_id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        // set of data to update
        $data = array(
            'work_title' => $title,
            'work_desc' => $description
        );

        // post data to update
        $this->work_model->push_update($data,$work_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$title." information has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);
    }

    // drop work
    function drop_work() {
        // post referer
        $referer = $this->input->server('HTTP_REFERER');
        // post data
         $work_id = $this->input->post('work_id');
         $title = $this->input->post('title');

        // remove work
        $this->work_model->drop_work($work_id);  
        
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$title." has been removed from database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);
    }

    // helpers view
    function helpers() {

        // pass data to header view
        $head["nav"] = "helpers";

        // pull works from db
        $data["works"] = $this->work_model->pull_work("");
 
        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('helpers',$data);
        $this->load->view('modal');
        $this->load->view('footer');

    }

    // add new helper
    function new_helper() {
        // referer of post data
        $referer = $this->input->server('HTTP_REFERER');
    }

    // API 
    function unit_members(){
        $unit_id = $this->input->post('unit_id');
        $members = $this->member_model->pull_members($unit_id);
        $option = "";
        foreach($members as $m) {
            $option .= "<option value='".$m->member_id."'>".$m->f_name." ".$m->l_name."</option>";
        }
        echo $option;

    }
}

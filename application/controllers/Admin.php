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
        $this->load->model('helper_model');
        $this->load->model('pet_model');
        $this->load->model('account_model');
        $this->load->model('activity_model');
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
        // push activity
        $this->push_activity('created new unit');

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

        // push activity
        $this->push_activity('update details of unit '.$number);

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

        // push activity
        $this->push_activity('created new member account for '.$f_name. ' '.$l_name);

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

        // push activity
        $this->push_activity('update member details of '. $f_name . ' '.$l_name);

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

        // push activity
        $this->push_activity('removed member '. $member_name);

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

        // push activity
        $member_name = $this->member_model->pull_member_name($member_id);
        $this->push_activity('add car record to  '. $member_name);

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

        // push activity
        $this->push_activity('updated record of  '. $plate_number);

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

        // push activity
        $this->push_activity('created new work '.$title);

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

        // push activity
        $this->push_activity('update details of work '.$title);

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

        // push activity
        $this->push_activity('removed '.$title." work");

        // redirect page to referer
        redirect($referer);
    }

    // helpers view
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

    // add new helper
    function new_helper() {
        // referer of post data
        $referer = $this->input->server('HTTP_REFERER');
        $l_name = $this->input->post('l_name');
        $f_name = $this->input->post('f_name');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $image = '';
        // multiple post data of work
        $work = $this->input->post('work_id[]');
        
        // upload image
        $config["upload_path"] = './img/'; // directory for uploads
        $config['allowed_types'] = 'gif|jpg|png'; // file types
        $this->load->library('upload', $config); // load library
        if($this->upload->do_upload('user_image')) { // attempt to upload
            // if success set the file directory
            $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
        }

        // create data array push to db
        $data = array(
            'l_name' => $l_name,
            'f_name' => $f_name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'mobile' => $mobile,
            'status' => 'available',
            'image' => $image,
            'date_created' => date('Y-m-d H:i:s')
        );

        // call mopdel and push data to database
        $helper_id = $this->helper_model->push_data($data);

        // loop posted work
        foreach($work as $w) {
            $data = array(
                'work_id' => $w,
                'helper_id' => $helper_id
            );
            // push data to database
            $this->helper_model->push_helper_work($data);
        }

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$f_name . " " . $l_name ." has been added to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('create helper account for '.$f_name.' '.$l_name);

        // redirect page to referer
        redirect($referer);
    }

    // update helper info
    function update_helper() {
        $referer = $this->input->server('HTTP_REFERER');
        $helper_id = $this->input->post('helper_id');
        $l_name = $this->input->post('l_name');
        $f_name = $this->input->post('f_name');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $image = '';

        if(!empty($_FILES["user_image"]["name"])) {
            // upload image
            $config["upload_path"] = './img/'; // directory for uploads
            $config['allowed_types'] = 'gif|jpg|png'; // file types
            $this->load->library('upload', $config); // load library
            if($this->upload->do_upload('user_image')){

                // check first if image dir is not empty delete the old file
                $old_image = $this->helper_model->pull_helper_image($helper_id);
                // new image 
                // if success set the file directory
                $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
                $data = array(
                    'image' => $image
                );
                $this->helper_model->push_update($data,$helper_id);
                // delete old
                if(!empty($old_image)) {
                    unlink("./".$old_image);
                }
            }
        }

        // multiple post data of work
        $work = $this->input->post('work_id[]');
        // drop all work related to helper
        $this->helper_model->drop_work($helper_id);
        // loop posted work
        foreach($work as $w) {
            $data = array(
                'work_id' => $w,
                'helper_id' => $helper_id
            );
            // push data to database
            $this->helper_model->push_helper_work($data);
        }

        // update post data
        // create data array push to db
        $data = array(
            'l_name' => $l_name,
            'f_name' => $f_name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'mobile' => $mobile,
        );
        // push to db
        $this->helper_model->push_update($data,$helper_id);
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$f_name . " " . $l_name ." data has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('update helper details of '.$f_name . " ". $l_name);

        // redirect page to referer
        redirect($referer);

    }

    // drop helper
    function drop_helper() {
        $referer = $this->input->server('HTTP_REFERER');
        $helper_id = $this->input->post('helper_id');
        $helper_name = $this->input->post('helper_name');

        // call method to drop helper
        // drop work related to 
        $this->helper_model->drop_work($helper_id);
        // drop image
        $old_image = $this->helper_model->pull_helper_image($helper_id);
        if(!empty($old_image)) {
            unlink("./".$old_image);
        }
        // drop helper data
        $this->helper_model->drop_helper($helper_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$f_name . " " . $l_name ." has been removed to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('removed helper '.$helper_name);

        // redirect page to referer
        redirect($referer);
    }
        
    // view for pets
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

    // create new pet record
    function new_pet() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $unit_id = $this->input->post('unit_id');
        $type_id = $this->input->post('type_id');
        $breed = $this->input->post('breed');
        $image = "";

        // upload image
        $config["upload_path"] = './img/'; // directory for uploads
        $config['allowed_types'] = 'gif|jpg|png'; // file types
        $this->load->library('upload', $config); // load library
        if($this->upload->do_upload('pet_image')) { // attempt to upload
            // if success set the file directory
            $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
        }
        echo $image;
        $data = array(
            'unit_id' => $unit_id,
            'type_id' => $type_id,
            'breed' => $breed,
            'image' => $image,
            'date_created' => date('Y-m-d H:i:s')
        );

        // call model and post data
        $this->pet_model->push_pet($data);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$breed . " has been added to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push data
        // unit number 
        $unit_number = $this->unit_model->pull_unit_number($unit_id);
        $this->push_activity('add '.$breed.' to unit '.$unit_number);

        // redirect page to referer
        redirect($referer);
    }

    // update pet
    function update_pet() {
         // post data
         $referer = $this->input->server('HTTP_REFERER');
         $pet_id = $this->input->post('pet_id');
         $unit_id = $this->input->post('unit_id');
         $type_id = $this->input->post('type_id');
         $breed = $this->input->post('breed');

         if(!empty($_FILES["pet_image"]["name"])) {
            // upload image
            $config["upload_path"] = './img/'; // directory for uploads
            $config['allowed_types'] = 'gif|jpg|png'; // file types
            $this->load->library('upload', $config); // load library
            if($this->upload->do_upload('pet_image')){
                // check first if image dir is not empty delete the old file
                $old_image = $this->pet_model->pull_pet_image($car_id);
                // new image 
                // if success set the file directory
                $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
                $data = array(
                    'image' => $image
                );
                $this->pet_model->push_update($data,$pet_id);
                // delete old
                if(!empty($old_image)) {
                    unlink("./".$old_image);
                }
            }
        }
        // create array of data
        $data = array(
            'unit_id' => $unit_id,
            'type_id' => $type_id,
            'breed' => $breed
        );

        // call model and push data
        $this->pet_model->push_update($data,$pet_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$breed . " has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('update pet details of '.$breed);

        // redirect page to referer
        redirect($referer);
         
    }

    // drop pet
    function drop_pet() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $breed = $this->input->post('breed');
        $pet_id = $this->input->post('pet_id');

        // call model to drop pet
        $this->pet_model->drop_pet($pet_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$breed . " has been removed from database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('removed pet '.$breed);

        // redirect page to referer
        redirect($referer);

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

    // create new pet type
    function new_pet_type() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $type_desc = $this->input->post('type_desc');

        // create data array and push to db
        $data = array('type_desc' => $type_desc);

        // call model and push data
        $this->pet_model->push_type($data);
        
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$type_desc . " has been added to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('create new pet type '.$type_desc);

        // redirect page to referer
        redirect($referer);
    }

    function update_pet_type() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $type_desc = $this->input->post('type_desc');
        $type_id = $this->input->post('type_id');

        // create data array and push to db
        $data = array('type_desc' => $type_desc);

        // call model and update 
        $this->pet_model->push_type_update($data,$type_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$type_desc . " has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('update pet type '.$type_desc);

        // redirect page to referer
        redirect($referer);
    }

    function drop_pet_type() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $type_desc = $this->input->post('type_desc');
        $type_id = $this->input->post('type_id');

        // call model and remove pet type
        $this->pet_model->drop_pet_type($type_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$type_desc . " has been removed from database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('removed pet type '.$type_desc);

        // redirect page to referer
        redirect($referer);
    }

    // system accounts
    function account() {
        $referer = $this->input->server('HTTP_REFERER');

        // pass data to header view
        $head["nav"] = "settings";

        // view data
        $data["users"] = $this->account_model->pull_account('');

        // views
        $this->load->view('head',$head);
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('account',$data);
        $this->load->view('modal');
        $this->load->view('footer');
    }

    function new_user() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $l_name = $this->input->post('l_name');
        $f_name = $this->input->post('f_name');
        $uac = $this->input->post('uac');
        $contact = $this->input->post('contact');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $image = "";

        // upload image
        $config["upload_path"] = './img/'; // directory for uploads
        $config['allowed_types'] = 'gif|jpg|png'; // file types
        $this->load->library('upload', $config); // load library
        if($this->upload->do_upload('user_image')) { // attempt to upload
            // if success set the file directory
            $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
        }

        // create array and pass data to model
        $data = array(
            'l_name' => $l_name,
            'f_name' => $f_name,
            'username' => $email,
            'password' => md5($password),
            'uac' => $uac,
            'image' => $image,
            'contact' => $contact,
            'email' => $email
        );

        $this->account_model->push_user($data);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$f_name . " " . $l_name ." has been added to database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('create new account for '.$f_name." ".$l_name);

        // redirect page to referer
        redirect($referer);
        
    }

    function update_user() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $user_id = $this->input->post('user_id');
        $l_name = $this->input->post('l_name');
        $f_name = $this->input->post('f_name');
        $uac = $this->input->post('uac');
        $contact = $this->input->post('contact');
        $email = $this->input->post('email');
        $image = "";
        
        // check if there are new image uploaded on the post
        if(!empty($_FILES["user_image"]["name"])) {
            // upload image
            $config["upload_path"] = './img/'; // directory for uploads
            $config['allowed_types'] = 'gif|jpg|png'; // file types
            $this->load->library('upload', $config); // load library
            if($this->upload->do_upload('user_image')){

                // check first if image dir is not empty delete the old file
                $old_image = $this->account_model->pull_user_image($user_id);
                // new image 
                // if success set the file directory
                $image = 'img/' . $this->upload->data('raw_name').$this->upload->data('file_ext');
                $data = array(
                    'image' => $image
                );
                $this->account_model->push_update($data,$user_id);
                // delete old
                if(!empty($old_image)) {
                    unlink("./".$old_image);
                }
            }
        }

        // create data array and pass to model
        $data = array(
            'l_name' => $l_name,
            'f_name' => $f_name,
            'uac' => $uac,
            'contact' => $contact,
            'email' => $email,
            'username' => $email
        );

        // call model
        $this->account_model->push_update($data,$user_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> ".$f_name . " " . $l_name ." information has been added updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity('update user details of '. $f_name." ".$l_name);

        // redirect page to referer
        redirect($referer);
    }

    //  method to drop user
    function drop_user() {

        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('user_name');

        // get image url to remove also the photo
        $old_image = $this->account_model->pull_user_image($user_id);
        // delete the file
        if(!empty($old_image)) {
            unlink("./".$old_image);
        }
        // call model to drop member
        $this->account_model->drop_user($user_id);
        
        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $name .  " has been removed from database."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);

        // push activity
        $this->push_activity("removed user account of ".$name);

        // redirect page to referer
        redirect($referer);
    }

    function check_password() {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('current');

        $result = $this->account_model->pull_password($user_id);

        echo $result == md5($password) ? '1' : '0';
        
    }

    function update_password() {
        // post data
        $referer = $this->input->server('HTTP_REFERER');
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('confirm');
        $name = $this->input->post('name');
        
        // create data array
        $data = array( 'password' => md5($password));
        
        // call model to update password 
        $this->account_model->push_update($data,$user_id);

        // create flash data session for notification
        $result_data = array(
            'class' => "success",
            'message' => "<strong>Success!</strong> " . $name .  " password has been updated."
        );
        // store temporary session
        $this->session->set_flashdata('result',$result_data);
        // redirect page to referer
        redirect($referer);


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

    function push_activity($activity) {
        // insert activity
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'act_desc' => $activity,
            'date_created' => data("Y-m-d H:i:s")
        );
        // insert activity pass array to model
        $this->activity_model->push_activity($data);
    }

    function api_password_update() {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');

        // create data array
        $data = array( 'password' => md5($password));
        
        // call model to update password 
        $this->account_model->push_update($data,$user_id);

    }
}

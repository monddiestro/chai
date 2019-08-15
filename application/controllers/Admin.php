<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function index() {
        $this->load->view('head');
        $this->load->view('sidebar');
        $this->load->view('top-bar');
        $this->load->view('content');
        $this->load->view('modal');
        $this->load->view('footer');
    }
}

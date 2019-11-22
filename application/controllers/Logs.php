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

    }
    
}

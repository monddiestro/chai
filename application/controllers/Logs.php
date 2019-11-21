<?php 
class Logs extends CI_Contoller
{
    public function __construct()
    {
        parent::__construct();
        //load all models need first
        $this->load->model('account_model');
        $this->load->model('activity_model');
    }

    
}

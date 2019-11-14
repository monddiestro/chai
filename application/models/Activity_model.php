<?php 
class Activity_model extends CI_model
{  
   function push_activity($data) {
       $this->db->insert('activity_tbl',$data);
   } 
   
}

<?php 
class Activity_model extends CI_model
{  
   function push_activity($data) {
       $this->db->insert('activity_tbl',$data);
   } 

   function pull_activity() {
       $this->db->order_by('activity_tbl.date_created','DESC');
       $this->db->join('accounts_tbl','activity_tbl.user_id = accounts_tbl.user_id', 'left');
       $this->db->select('f_name,l_name,act_desc,activity_tbl.date_created,image,timestampdiff(minute,activity_tbl.date_created,now()) as date_diff');
       $query = $this->db->get('activity_tbl');
       return $query->result();
   }
   
}

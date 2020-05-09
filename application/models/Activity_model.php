<?php 
class Activity_model extends CI_model
{  
   function push_activity($data) {
       $this->db->insert('activity_tbl',$data);
   } 

   function pull_activity($limit,$offset) {
       empty($limit) ? '' : $this->db->limit($limit,$offset);
       $this->db->order_by('activity_tbl.date_created','DESC');
       $this->db->join('accounts_tbl','activity_tbl.user_id = accounts_tbl.user_id', 'left');
       $this->db->select('f_name,l_name,act_desc,activity_tbl.date_created,image,timestampdiff(minute,activity_tbl.date_created,now()) as date_diff');
       $query = $this->db->get('activity_tbl');
       return $query->result();
   }

   function pull_activity_cnt() {
       $query = $this->db->get('activity_tbl');
       $query = $query->num_rows();
       return $query;
   }

//    function push new visitor
   function push_visitor($data) {
       $this->db->insert('visitors_log',$data);
       $this->db->select_max('visitor_id','visitor_id');
       $query = $this->db->get('visitors_log');
       $query = $query->row();
       return $query->visitor_id;
   }
   
//  pull visitors data
   function pull_visitors($limit,$offset,$visitor_id) {
       empty($limit) ? '' : $this->db->limit($limit,$offset);
       empty($visitor_id) ? '' : $this->db->where('visitor_id',$visitor_id);
       $this->db->order_by('date_in', 'DESC');
       $this->db->join('units_tbl', 'visitors_log.unit_id = units_tbl.unit_id', 'left');
       $query = $this->db->get('visitors_log');
       return $query->result();
   }

//  push exit
   function push_exit($visitor_id) {
       $this->db->where('visitor_id',$visitor_id);
       $this->db->set('date_out',date('Y-m-d H:i:s'));
       $this->db->update('visitors_log');
   }
// pull visitor name
   function pull_visitor_name($visitor_id) {
       $this->db->where('visitor_id',$visitor_id);
       $this->db->select('CONCAT(first_name, " ", last_name) as name');
       $query = $this->db->get('visitors_log');
       $query = $query->row();
       return $query->name;
   }

//    pull count of visitors
   function pull_visitors_cnt() {
       $query = $this->db->get('visitors_log');
       $query = $query->num_rows();
       return $query;
   }


}

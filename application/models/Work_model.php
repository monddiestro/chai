<?php 
class Work_model extends CI_Model
{
    // push data to work table
    function push_work($data) {
        $this->db->insert('work_tbl',$data);
    }

    //  read and return all work registered
    function pull_work($work_id) {
        empty($work_id) ? '' : $this->db->where('work_id',$work_id);
        $query = $this->db->get('work_tbl');
        return $query->result();
    }

    // update set of data
    function push_update($data,$work_id) {
        $this->db->where('work_id',$work_id);
        $this->db->set($data);
        $this->db->update('work_tbl');
    }

    // remove work data
    function drop_work($work_id) {
        $this->db->where('work_id',$work_id);
        $this->db->delete('work_tbl');
    }
}

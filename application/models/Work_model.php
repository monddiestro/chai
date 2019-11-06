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

    function pull_helpers($work_id) {
        $this->db->where('helpers_work_tbl.work_id', $work_id);
        $this->db->where('status','available');
        $this->db->join('helpers_tbl','helpers_work_tbl.helper_id = helpers_tbl.helper_id','left');
        $this->db->join('work_tbl','helpers_work_tbl.work_id = work_tbl.work_id', 'left');
        $query = $this->db->get('helpers_work_tbl');
        return $query->result();
    }
}

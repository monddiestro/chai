<?php
class Helper_model extends CI_Model
{
    function push_data($data) {
        $this->db->insert('helpers_tbl',$data);
        $this->db->select_max('helper_id','helper_id');
        $query = $this->db->get('helpers_tbl');
        $query = $query->row();
        return $query->helper_id;
    }

    function pull_data($helper_id,$limit,$offset) {
        empty($helper_id) ? '' : $this->db->where('helper_id',$helper_id);
        empty($limit) ? '' : $this->db->limit($limit,$offset);
        $query = $this->db->get('helpers_tbl');
        return $query->result();
    }

    function push_helper_work($data) {
        $this->db->insert('helpers_work_tbl',$data);
    }

    function pull_helper_work($helper_id) {
        empty($helper_id) ? '' : $this->db->where('helpers_work_tbl.helper_id',$helper_id);
        $this->db->join('work_tbl','helpers_work_tbl.work_id = work_tbl.work_id');
        $query = $this->db->get('helpers_work_tbl');
        return $query->result();
    }

    function pull_helper_image($helper_id) {
        $this->db->where('helper_id',$helper_id);
        $this->db->select('image');
        $query = $this->db->get('helpers_tbl');
        $query = $query->row();
        return $query->image;
    }

    function push_update($data,$helper_id) {
        $this->db->where('helper_id',$helper_id);
        $this->db->set($data);
        $this->db->update('helpers_tbl');
    }

    function drop_work($helper_id) {
        $this->db->where('helper_id',$helper_id);
        $this->db->delete('helpers_work_tbl');
    }
    
    function drop_helper($helper_id) {
        $this->db->where('helper_id', $helper_id);
        $this->db->delete('helpers_tbl');
    }

    function pull_name($helper_id) {
        $this->db->where('helper_id',$helper_id);
        $this->db->select('CONCAT(f_name, " ", l_name) as name');
        $query = $this->db->get('helpers_tbl');
        $query = $query->row();
        return $query->name;
    }

    function pull_helper_cnt() {
        $query = $this->db->get('helpers_tbl');
        $query = $query->num_rows();
        return $query;
    }

}

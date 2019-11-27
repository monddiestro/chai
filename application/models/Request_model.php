<?php 
class Request_model extends CI_Model
{
    function push_request($data) {
        $this->db->insert('request_tbl',$data);
        $this->db->select_max('request_id','request_id');
        $query = $this->db->get('request_tbl');
        $query = $query->row();
        return $query->request_id;
    }

    function pull_request($request_id,$status) {
        !empty($request_id) ? $this->db->where('request_id',$request_id) : '';
        if($status == 'done') {
            $this->db->where('request_tbl.status','done');
        } else {
            $this->db->where('request_tbl.status','in-progress');
            $this->db->or_where('request_tbl.status','pending');

        }
        $this->db->order_by('date_request', 'DESC');
        //$this->db->join('helpers_tbl', 'request_tbl.helper_id = helpers_tbl.helper_id','left');
        $this->db->join('units_tbl','request_tbl.unit_id = units_tbl.unit_id','left');
        $this->db->join('work_tbl', 'request_tbl.work_id = work_tbl.work_id');
        $query = $this->db->get('request_tbl');
        return $query->result();
    }

    function pull_request_details($status) {
        empty($status) ? '' : $this->db->where('request_tbl.status',$status);
        $this->db->order_by('date_request', 'DESC');
        $this->db->join('helpers_tbl', 'request_tbl.helper_id = helpers_tbl.helper_id','left');
        $this->db->join('units_tbl','request_tbl.unit_id = units_tbl.unit_id','left');
        $this->db->join('work_tbl', 'request_tbl.work_id = work_tbl.work_id');
        $query = $this->db->get('request_tbl');
        return $query->result();
    }

    function push_update($data,$request_id) {
        $this->db->where('request_id',$request_id);
        $this->db->set($data);
        $this->db->update('request_tbl');
    }

    function pull_helpers() {
        $this->db->where('helpers_tbl.status','available');
        $this->db->join('work_tbl','helpers_work_tbl.work_id = work_tbl.work_id','left');
        $this->db->join('helpers_tbl','helpers_work_tbl.helper_id = helpers_tbl.helper_id','left');
        $this->db->order_by('helpers_tbl.helper_id','ASC');
        $query = $this->db->get('helpers_work_tbl');
        return $query->result();
    }



    

}

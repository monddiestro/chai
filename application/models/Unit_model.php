<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model
{
    // add new data to units table
    function push_unit($data) {
        $this->db->insert('units_tbl',$data);
    }

    // get all data from units table
    function pull_units($unit_id,$limit,$offset) {
        !empty($unit_id) ? $this->db->where('unit_id',$unit_id) : '';
        !empty($limit) ? $this->db->limit($limit,$offset) : '';
        $this->db->order_by('number','ASC');
        $query = $this->db->get('units_tbl');
        return $query->result();
    }

    // update unit
    function push_update($data,$id) {
        $this->db->where('unit_id',$id);
        $this->db->update('units_tbl',$data);
    }

    // function pull units registered
    function pull_unit_cnt() {
        $query = $this->db->get('units_tbl');
        return $query->num_rows();
    }

    function pull_unit_number($unit_id) {
        $this->db->where('unit_id',$unit_id);
        $this->db->select('number');
        $query = $this->db->get('units_tbl');
        $query = $query->row();
        return $query->number;
    }

    function pull_unit($unit_id) {
        $this->db->where('unit_id');
        $query = $this->db->get('units_tbl');
        return $query->result();
    }

    
}


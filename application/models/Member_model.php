<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_model extends CI_Model
{
    // add new member to members_tbl
    function push_member($data) {
        $this->db->insert('members_tbl', $data);
    }

    // function to pull members from members_tbl
    function pull_members($unit_id,$member_id,$offset,$limit) {
        empty($unit_id) ? '' :  $this->db->where('members_tbl.unit_id',$unit_id);;
        empty($member_id) ? '' : $this->db->where('members_tbl.member_id',$member_id);
        empty($limit) ? '' : $this->db->limit($limit,$offset);
        $this->db->join('units_tbl', 'members_tbl.unit_id = units_tbl.unit_id', 'left');
        $this->db->select('units_tbl.unit_id,units_tbl.number, units_tbl.address, members_tbl.member_id, members_tbl.f_name, members_tbl.l_name, members_tbl.email, members_tbl.phone, members_tbl.mobile,members_tbl.image, members_tbl.type');
        $this->db->order_by('f_name','ASC');
        $query = $this->db->get('members_tbl');
        return $query->result();
    }

    // function to get image url
    function pull_member_image($member_id) {
        $this->db->where('member_id',$member_id);
        $this->db->select('image');
        $query = $this->db->get('members_tbl');
        $query = $query->row();
        return $query->image;
    }

    // function push any update in members
    function push_update($data,$member_id) {
        $this->db->where('member_id',$member_id);
        $this->db->set($data);
        $this->db->update('members_tbl');
    }

    // function to drop member data
    function drop_member($member_id) {
        $this->db->where('member_id',$member_id);
        $this->db->delete('members_tbl');
    }

    // function to pull all members registered
    // pull total counts of car registered
    function pull_member_cnt() {
        $query = $this->db->get('members_tbl');
        return $query->num_rows();
    }

    function pull_member_name($member_id) {
        $this->db->where('member_id',$member_id);
        $this->db->select('CONCAT(f_name," ", l_name) as name');
        $query = $this->db->get('members_tbl');
        $query = $query->row();
        return $query->name;
    }

    function pull_member_unit($member_id) {
        $this->db->where('member_id',$member_id);
        $this->db->select('unit_id');
        $query = $this->db->get('members_tbl');
        $query = $query->row();
        return $query->unit_id;
    }
    
    function pull_unit_members($member_id, $unit_id) {
        $this->db->where('unit_id',$unit_id);
        $this->db->where('member_id <>',$member_id);
        $query = $this->db->get('members_tbl');
        return $query->result();
    }


}

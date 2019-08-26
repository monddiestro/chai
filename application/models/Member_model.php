<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_model extends CI_Model
{
    // add new member to members_tbl
    function push_member($data) {
        $this->db->insert('members_tbl', $data);
    }

    // function to pull members from members_tbl
    function pull_members($unit_id) {
        if(!empty($unit_id)) {
            $this->db->where('unit_id',$unit_id);
        }
        $this->db->join('units_tbl', 'members_tbl.id = units_tbl.id', 'left');
        $query = $this->db->get('members_tbl');
        return $query->result();
    }

    // function to get image url
    function pull_member_image($member_id) {
        $this->db->where('id',$member_id);
        $this->db->select('image');
        $query = $this->db->get('members_tbl');
        $query = $query->row();
        return $query->image;
    }

    // function push any update in members
    function push_update($data,$member_id) {
        $this->db->where('id',$member_id);
        $this->db->set($data);
        $this->db->update('members_tbl');
    }

    // function to drop member data
    function drop_member($member_id) {
        $this->db->where('id',$member_id);
        $this->db->delete('members_tbl');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_model extends CI_Model
{
    // add new member to members_tbl
    function push_member($data) {
        $this->db->insert('members_model', $data);
    }
}

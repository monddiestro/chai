<?php 
class Account_model extends CI_Model
{
    function pull_username($username) {
        $this->db->where('username',$username);
        $query = $this->db->get('accounts_tbl');
        return $query->num_rows();
    }

    function pull_user($username,$password) {
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $query = $this->db->get('accounts_tbl');
        return $query->result();
    }
}

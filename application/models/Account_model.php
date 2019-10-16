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

    function pull_account($user_id) {
        empty($user_id) ? '' : $this->db->where('user_id',$user_id);
        $query = $this->db->get('accounts_tbl');
        return $query->result();
    }

    function push_user($data) {
        $this->db->insert('accounts_tbl',$data);
    }

    function pull_user_image($user_id) {
        $this->db->where('user_id',$user_id);
        $this->db->select('image');
        $query = $this->db->get('accounts_tbl');
        $query = $query->row();
        return $query->image;
    }

    function push_update($data,$user_id) {
        $this->db->where('user_id',$user_id);
        $this->db->set($data);
        $this->db->update('accounts_tbl');
    }

    function drop_user($user_id) {
        $this->db->where('user_id',$user_id);
        $this->db->delete('accounts_tbl');
    }
}

<?php 
class Pet_model extends CI_Model
{
    function push_type($data) {
        $this->db->insert('pet_type_tbl',$data);
    }
    
    function pull_type($type_id) {
        empty($type_id) ? '' : $this->dn->where('type_id',$type_id);
        $query = $this->db->get('pet_type_tbl');
        return $query = $query->result();
    }

    function push_type_update($data,$type_id) {
        $this->db->where('type_id',$type_id);
        $this->db->set($data);
        $this->db->update('pet_type_tbl');
        // return $this->db->last_query();
    }

    function drop_pet_type($type_id) {
        $this->db->where('type_id',$type_id);
        $this->db->delete('pet_type_tbl');
    }
}

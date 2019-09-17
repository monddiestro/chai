<?php
class Car_model extends CI_Model
{
    function push_car($data) {
        $this->db->insert('cars_tbl',$data);
    }

    function pull_car($unit_id) {
        if(!empty($unit_id)) {
            $this->db->where('cars_tbl.unit_id',$unit_id);
        }
        $this->db->join('members_tbl', 'cars_tbl.member_id = members_tbl.member_id', 'left');
        $this->db->select('cars_tbl.image, cars_tbl.id, cars_tbl.make, cars_tbl.model, cars_tbl.plate_number, cars_tbl.color, cars_tbl.member_id, cars_tbl.unit_id,members_tbl.f_name, members_tbl.l_name');
        $query = $this->db->get('cars_tbl');
        $query = $query->result();
        return $query;
    }

    function pull_car_image($car_id) {
        $this->db->where('id',$car_id);
        $this->db->select('image');
        $query = $this->db->get('cars_tbl');
        $query = $query->row();
        return $query->image;
    }

    function push_update($data,$car_id) {
        $this->db->where('id',$car_id);
        $this->db->set($data);
        $this->db->update('cars_tbl');
    }

    
}

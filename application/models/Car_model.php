<?php
class Car_model extends CI_Model
{
    function push_car($data) {
        $this->db->insert('cars_tbl',$data);
    }

    function pull_car($unit_id,$limit,$offset,$car_id) {

        empty($unit_id) ? '' : $this->db->where('cars_tbl.unit_id',$unit_id);
        empty($limit) ? '' : $this->db->limit($limit,$offset);
        empty($car_id) ? '' : $this->db->where('id',$car_id);
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

    // pull car details
    function pull_car_name($car_id) {
        $this->db->where('id',$car_id);
        $this->db->select('CONCAT(make," ",model,"(",plate_number,")") as car');
        $query = $this->db->get('cars_tbl');
        $query = $query->row();
        return $query->car;
    }

    function push_update($data,$car_id) {
        $this->db->where('id',$car_id);
        $this->db->set($data);
        $this->db->update('cars_tbl');
    }

    // pull total counts of car registered
    function pull_car_cnt() {
        $query = $this->db->get('cars_tbl');
        return $query->num_rows();
    }

    function pull_unit_cars($unit_id) {
        $this->db->where('cars_tbl.unit_id',$unit_id);
        $this->db->join('members_tbl','cars_tbl.member_id = members_tbl.member_id', 'left');
        $this->db->select('members_tbl.image as member_image,f_name,l_name,cars_tbl.image,make,model,color,plate_number');
        $query = $this->db->get('cars_tbl');
        return $query->result();
    }

    function drop_car($car_id) {
        $this->db->where('id',$car_id);
        $this->db->delete('cars_tbl');

    }
    

    
}

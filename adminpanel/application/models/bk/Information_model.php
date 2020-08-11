<?php

class Information_model extends CI_Model {

    public function detailsinformationRcord($page = "") {


        $this->db->select('*');

        $this->db->from('information_page');

        $this->db->order_by("id", "ASC");

        $start = ($page == 1) ? 0 : ($page - 1) * 5;

        $this->db->limit(5, $start);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function information_total() {

        $this->db->select("COUNT('id') as num");

        $this->db->from("information_page");

        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }

    function store_information($data) {
        $insert = $this->db->insert('information_page', $data);
        return $insert;
    }
    
   
    
    

}

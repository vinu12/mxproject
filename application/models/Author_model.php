<?php

class Author_model extends CI_Model {

    public function detailsauthorRecord($page = "") {


        $this->db->select('*');

        $this->db->from('author');

        $this->db->order_by("author_id", "ASC");

        $start = ($page == 1) ? 0 : ($page - 1) * 4;

        $this->db->limit(4, $start);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function author_total() {

        $this->db->select("COUNT('author_id') as num");

        $this->db->from("author");

        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }

    function store_authorrecord($data) {
        $insert = $this->db->insert('author', $data);
        return $insert;
    }

    public function update_Author_model($id, $data) {
      $this->db->where('author_id', $id);
        $this->db->update('author', $data);
        return $this;
    }
    
    

}

<?php

class Order_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	

    
    function orderdetails($UserRecord)
    {
        
        $this->db->trans_start();
        $this->db->insert('orders', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    
    }
    
   
	
	

}

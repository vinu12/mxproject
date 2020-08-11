<?php
 class Event_register_model extends CI_Model
 {
     public function __construct() {
         parent::__construct();
         $this->load->database();
     }

          public function event_register($data)
     {
             
         return $query = $this->db->insert('event_details', $data);
         //  echo $this->db->last_query(); die;
		  // $query->result();
     }
     
      public function show_event() {
          
        $this->db->select("COUNT('event_id') as num");

        $this->db->from("event_details");

        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }
    
     public function info($page = "") {


        $this->db->select('*');

        $this->db->from('event_details');

        $this->db->order_by("event_id", "ASC");

        $start = ($page == 1) ? 0 : ($page - 1) * 5;

        $this->db->limit(5, $start);

        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function activate($url)
    {
        $query = $this->db->set('status', '0');
        $this->db->where('event_id', $url);
        $this->db->update('event_details');
       // echo $this->db->last_query();
        return $query;
    }
    
    public function inactivate($url)
    {
       
        $query = $this->db->set('status', '1');
        $this->db->where('event_id', $url);
        $this->db->update('event_details');
        //echo $this->db->last_query();
        return $query;
    }
    
    
    
    
    
    
     
 }


?>

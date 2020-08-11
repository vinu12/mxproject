<?php

class Deals_model extends CI_Model {

   
	
function dealslist()
{
	
	
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->Where('dealsid','');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		//print_r($this->db->last_query()); exit;
		$querycount =$query->num_rows();
       if($querycount>0)
	   {
        return $query->result_array();
	   }
	   else
	   {
		   return 0;
	   }
}


	function check_record_deals($checkid)
	{

		$this->db->select('*');
		$this->db->from('deals');
		$this->db->Where('id',$checkid);
		$query = $this->db->get();
		$querycount =$query->num_rows();
		if($querycount>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
		
		
	}




	function editspecialofferData($editid)
	{
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->Where('id',$editid);
		
		$query = $this->db->get();
		
		$querycount =$query->num_rows();
		if($querycount>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
}

function specialoffer($delid)
{
	
	
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->Where('dealsid',$delid);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		//print_r($this->db->last_query()); exit;
		$querycount =$query->num_rows();
       if($querycount>0)
	   {
        return $query->result_array();
	   }
	   else
	   {
		   return 0;
	   }
}


	function dealseditlist($editid)
	{
		
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->Where('id',$editid);
		
		$query = $this->db->get();
	
		$querycount =$query->num_rows();
       if($querycount>0)
	   {
        return $query->result_array();
	   }
	   else
	   {
		   return 0;
	   }
		
		
	}
	
	
	function Checkdealdata($dealid)
	{
		
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->Where('id',$dealid);
		
		$query = $this->db->get();
	
		$querycount =$query->num_rows();
       if($querycount>0)
	   {
        return $query->result_array();
	   }
	   else
	   {
		   return 0;
	   }
		
	}

	
	function deletespecialoffer($deleteid)
	{
		$this->db->where('id', $deleteid);
        $this->db->delete('deals');
	}


function deletedeals($deleteid)
	{
		$this->db->where('id', $deleteid);
        $this->db->delete('deals');
		
	}
	

function deletemanagenotification($deleteid)
{
	$this->db->where('nid', $deleteid);
    $this->db->delete('manage_notification');
}


function deletedealnotification($deleteid)
{
	$this->db->where('did', $deleteid);
    $this->db->delete('manage_notification');
}
	
	

    function adddeals($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('deals', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	
	function addmanage_notification($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('manage_notification', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	
}


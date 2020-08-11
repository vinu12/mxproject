<?php

class News_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */

	function deletenews($deleteid)
	{
		$this->db->where('id', $deleteid);
        $this->db->delete('news');
		
	}
	
	
	

	
		
	
}


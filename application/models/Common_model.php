<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Common_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
	}
	
	

	
	public function common_insert($tbl_name = false, $data_array = false)
	{
		$ins_data = $this->db->insert($tbl_name, $data_array);
		if($ins_data){
			return $last_id = $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	
function decodeEmoticons($src) {
    $replaced = preg_replace("/\\\\u([0-9A-F]{1,4})/i", "&#x$1;", $src);
    $result = mb_convert_encoding($replaced, "UTF-16", "HTML-ENTITIES");
    $result = mb_convert_encoding($result, 'utf-8', 'utf-16');
    return $result;
}



   public function verify_mail($userid) {
	   
        $this->db->select('id');
        $this->db->from('user_register');
		$this->db->where('id',$userid);
        
        $query = $this->db->get();
		//print_r($this->db->last_query()); exit;
		if($query->num_rows() == 1){
		  return $query->result();
		}else{
		  return false;
		}
    }
	
	public function mail_status($userid)
	{ 
	    $this->db->set('status', '1');             //value that used to update column  
		$this->db->where('id',$userid);
		$query = $this->db->update('user_register');         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	public function userDevice_status($userid)
	{ 
	    $this->db->set('status', '1');             //value that used to update column  
		$this->db->where('userid',$userid);
		$query = $this->db->update('userdevice');         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	

	function checkexistRecord($oauid)
	{
		$this->db->select('*');

        $this->db->from('user_register');
        $this->db->where('oauth_uid', $oauid);
	   
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		$data_array = $query->row();
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return false;
		}
	}
	
	
	
	function checkemailexistRecord($emailid)
	{
		
		
		$this->db->select('*');

        $this->db->from('user_register');
       
	    $this->db->where('user_email', $emailid);
       
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		$data_array = $query->row();
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return false;
		}
	}
	
	
	
	function checkuserlogin($email,$password)
	{
		
		
		$this->db->select('*');

        $this->db->from('user_register');
        $this->db->where('user_email', $email);
	    $this->db->where('password', $password);
		//$this->db->where('status', 1);
		
       
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		//$data_array = $query->row();
		$data_array = $query->result_array();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	

	
	
	function existuserimg($userid)
	{
		$this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('id', $userid);
		
        $query = $this->db->get();        
		$data_array = $query->result_array();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	function existuserabout($userid)
	{
		
		$this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('id', $userid);
		
        $query = $this->db->get();        
		$data_array = $query->result_array();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	function existuserexp($userid)
	{
		
		$this->db->select('*');
        $this->db->from('experience');
        $this->db->where('userid', $userid);
		
        $query = $this->db->get();        
		$data_array = $query->result_array();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	function existuseredu($userid)
	{
		$this->db->select('*');
        $this->db->from('education');
        $this->db->where('userid', $userid);
		
        $query = $this->db->get();        
		$data_array = $query->result_array();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	
	
	
	function getuserprofile($userid)
	{
		$this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('id', $userid);
       
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		$data_array = $query->row();
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return false;
		}
	}
	
	
	function updateuserimage($userid, $data)
	{
		$updateArray =array();
		$updateArray['user_name'] =$data['user_name'];
		$updateArray['photo']     =$data['photo'];

		$this->db->where('id', $userid); //which row want to upgrade  
		
		$query = $this->db->update('user_register',$updateArray);         //table name
	
	   
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	function updateusername($userid, $data)
	{
		$updateArray =array();
		$updateArray['user_name'] =$data;

		$this->db->where('id', $userid); //which row want to upgrade  
		
		$query = $this->db->update('user_register',$updateArray);         //table name
	
	   
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	
	function updateuserabout($userid, $about)
	{
		$updateArray =array();
		
		$updateArray['bio']=$about;
		$this->db->where('id', $userid); //which row want to upgrade  
		
		$query = $this->db->update('user_register',$updateArray);         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function updateuserwork($userid, $workplace)
	{
		$updateArray =array();
		
		$updateArray['workplace']=$workplace;
		$this->db->where('id', $userid); //which row want to upgrade  
		
		$query = $this->db->update('user_register',$updateArray);         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function updatevisatype($userid, $visatype)
	{
		$updateArray =array();
		$updateArray['visatype']   =$visatype;
		
        $this->db->where('id', $userid);
		
		$query = $this->db->update('user_register', $updateArray);
		 
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function updatevisacountry($userid, $visacountry)
	{
		$updateArray =array();
		$updateArray['visacountry'] =$visacountry;
		
        $this->db->where('id', $userid);
		
		$query = $this->db->update('user_register', $updateArray);
		 
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function updateuserinfo($userid, $data)
	{
		$updateArray =array();
		
		$updateArray['user_mobile'] =$data['user_mobile'];
		$updateArray['country']   =$data['country'];
		
        $this->db->where('id', $userid);
		
		$query = $this->db->update('user_register', $updateArray);
		 
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function updatenotification($userid, $catid)
	{
		$updateArray =array();
		
		$updateArray['notificationsetting']=$catid;
		$this->db->where('id', $userid); //which row want to upgrade  
		
		$query = $this->db->update('user_register',$updateArray);         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	function checkuserexp($userid, $expid)
	{
		
		$this->db->select('*');
        $this->db->from('experience');
        $this->db->where('id', $expid);
	    $this->db->where('userid', $userid);
		
        $query = $this->db->get();
		$data_array = $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	function lastinsertexp($insert_id)
	{
		
		$this->db->select('*');
        $this->db->from('experience');
        $this->db->where('id', $insert_id);
		
        $query = $this->db->get();
		$data_array = $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	function updateuserexp($userid, $expid, $data)
	{
		$updateArray =array();
		
		$updateArray['designation']=$data['designation'];
		$updateArray['companyname']=$data['companyname'];
		$updateArray['description']='';
		$updateArray['location']   =$data['location'];
		$updateArray['fromdate']   =$data['fromdate'];
		$updateArray['todate']     =$data['todate'];
		
        $this->db->where('id', $expid);
		$this->db->where('userid', $userid);
		
		$query = $this->db->update('experience', $updateArray);
		 
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	

	
	function checkuseredu($userid, $edupid)
	{
		
		$this->db->select('*');
        $this->db->from('education');
        $this->db->where('id', $edupid);
	    $this->db->where('userid', $userid);
		
        $query = $this->db->get();
		$data_array = $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	function checkuserskill($userid, $skillid)
	{
		
		$this->db->select('*');
        $this->db->from('userskills');
        $this->db->where('id', $skillid);
	    $this->db->where('userid', $userid);
		
        $query = $this->db->get();
		$data_array = $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	function updateuserskill($userid, $skillid, $data)
	{
		$updateArray =array();
		
		$updateArray['skillname']=$data['skillname'];
		$updateArray['expyear']  =$data['year'];
		
        $this->db->where('id', $skillid);
		$this->db->where('userid', $userid);
		
		$query = $this->db->update('userskills', $updateArray);
		 
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	function lastinsertskill($insert_id)
	{
		
		$this->db->select('*');
        $this->db->from('userskills');
        $this->db->where('id', $insert_id);
		
        $query = $this->db->get();
		$data_array = $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	function lastinsertedu($insert_id)
	{
		
		$this->db->select('*');
        $this->db->from('education');
        $this->db->where('id', $insert_id);
		
        $query = $this->db->get();
		$data_array = $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	
	function updateuseredu($userid, $edupid, $data)
	{
		$updateArray =array();
		
		$updateArray['qualification']=$data['qualification'];
		$updateArray['collegename']  =$data['collegename'];
		$updateArray['description']  =$data['description'];
		$updateArray['location']     =$data['location'];
		$updateArray['fromyear']     =$data['fromyear'];
		$updateArray['toyear']       =$data['toyear'];
		
        $this->db->where('id', $edupid);
		$this->db->where('userid', $userid);
		
		$query = $this->db->update('education', $updateArray);
		 
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	function getusereducation($userid)
	{
		$this->db->select('*');
        $this->db->from('education');
        $this->db->where('userid', $userid);
       
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		$data_array =  $query->result();
		
		$cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return false;
		}
	}
	
	function getuserexperience($userid)
	{
		$this->db->select('*');
        $this->db->from('experience');
        $this->db->where('userid', $userid);
       
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		$data_array = $query->result();
		 $cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	function getuserskill($userid)
	{
		$this->db->select('*');
        $this->db->from('userskills');
        $this->db->where('userid', $userid);
       
        $query = $this->db->get();
        
		//print_r($this->db->last_query()); exit;
		$data_array = $query->result();
		 $cnt=$query->num_rows();
	    if($query->num_rows > 0)
		{
			return $data_array;
		}
		else
		{
			return 0;
		}
	}
	
	
	public function updatebookmark($newsid)
	{ 
	    $this->db->where('id', $newsid);
		$this->db->set('bookmark', 'bookmark+1', FALSE);
		$query = $this->db->update('news');

	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	public function updateunbookmark($newsid)
	{ 
	    $this->db->where('id', $newsid);
		$this->db->set('bookmark', 'bookmark-1', FALSE);
		$query = $this->db->update('news');

		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	  function common_insert_new($UserRecord) {

        $this->db->trans_start();
        $this->db->insert('user_register', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	

	
	 public function verify_otp($email, $otp) {


        $this->db->select('user_email, otp');
        $this->db->from('user_register');
        $this->db->where('user_email',$email);
        $this->db->where('otp',$otp);
       
        $query = $this->db->get();
		//print_r($this->db->last_query()); exit;
		if($query->num_rows() == 1){
		  return $query->result();
		}else{
		  return false;
		}
    }
	
	
	function Updateotp($email, $otp)
	{
		$updateArray =array();
		$updateArray['otp']=$otp;
		$this->db->where('user_email', $email); //which row want to upgrade  
		
		$query = $this->db->update('user_register',$updateArray);         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	 public function Email_otp($email) {


        $this->db->select('user_email, otp');
        $this->db->from('user_register');
        $this->db->where('user_email',$email);
        
       
        $query = $this->db->get();
		//print_r($this->db->last_query()); exit;
		if($query->num_rows() == 1){
		  return $query->result();
		}else{
		  return false;
		}
    }
	
	
	public function otp_status($email, $otp)
	{ 
	    $this->db->set('status', '1');             //value that used to update column  
		$this->db->where('user_email', $email); //which row want to upgrade  
		$this->db->where('otp', $otp);
		$query = $this->db->update('user_register');         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	public function resend_otp($email, $otp)
	{ 
	    $this->db->set('status', '1');             //value that used to update column  
		$this->db->where('user_email', $email); //which row want to upgrade  
		$this->db->where('otp', $otp);
		$query = $this->db->update('user_register');         //table name
	
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	

	public function updateData($table,$data,$where_array)
	{ 
	    $this->db->where($where_array);
		if($this->db->update($table,$data)){
			
			return true;
		}
		else{
			return false;
		}
	}
	public function sqlcount($table = false,$where = false)
	{
		$this->db->select('*');	
		$this->db->from($table); 
		if(isset($where) && !empty($where))
		{
			$this->db->where($where);	
		}
		//$this->db->limit($limit, $start);       
		$query = $this->db->get();
		//print_r($this->db->last_query()); exit;
		return $query->num_rows(); 
	}

	// Function for select data
	public function getData($table,$where='', $order_by = false, $order = false, $join_array = false, $limit = false)
	{
		//$this->db->select('*');
		$this->db->from($table);

		if(!empty($where))
		{
			$this->db->where($where);
		}
		
		if(!empty($order_by))
		{
			$this->db->order_by($order_by, $order); 	
		}



		if(!empty($join_array))
		{
			foreach ($join_array as $key => $value) {

				$this->db->join($key, $value); 	
			}
			
		}

		if(!empty($limit))
		{
			$this->db->limit($limit); 	
		}

		$result = $this->db->get();
		

		//print_r($this->db->last_query()); exit;
		return $result->result();
		//return $result;
	}

	// Function for select data
	public function getDataField($field = false, $table, $where='', $order_by = false, $order = false, $join_array = false, $limit = false)
	{
		$this->db->select($field);

		$this->db->from($table);

		if(!empty($where))
		{
			$this->db->where($where);
		}
		
		if(!empty($order_by))
		{
			$this->db->order_by($order_by, $order); 	
		}



		if(!empty($join_array))
		{
			foreach ($join_array as $key => $value) {

				$this->db->join($key, $value); 	
			}
			
		}

		if(!empty($limit))
		{
			$this->db->limit($limit); 	
		}

		$result = $this->db->get();
		

		//print_r($this->db->last_query()); exit;
		return $result->result();
		//return $result;
	}

	public function common_getRow($tbl_name = false, $where = false, $join_array = false)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);
		
		if(isset($where) && !empty($where))
		{
			$this->db->where($where);	
		}
		
		if(!empty($join_array))
		{
			foreach($join_array as $key=>$value){
				$this->db->join($key,$value);
			}	
		}
		
		$query = $this->db->get();
		
		$data_array = $query->row();
		//print_r($this->db->last_query()); exit;
		
		
		if($data_array)
		{
			return $data_array;
		}
		else{
			return false;
		}
	}
	public function deleteData($table,$where)
	{ 
		$this->db->where($where);
		if($this->db->delete($table))
		{
			return true;
		}
		else{
			return false;
		}
	}

	public function get_date($create_at)
	{
		 $seconds = $create_at / 1000;

         $date = date('d-M-Y',$seconds);

         return $date;
	}
	
	function sendPushNotification($registration_ids, $message)
	{
	  
	   $url = 'https://fcm.googleapis.com/fcm/send';
	   $fields = array(
	       'registration_ids' => array($registration_ids),
	       'data' => $message,
	   );
	   $headers = array(
	       'Authorization:key=' . GOOGLE_API_KEY,
	       'Content-Type: application/json'
	   );

	   $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url); 
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   // curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	    $result = curl_exec($ch);
	    curl_close($ch);
	   //return $result;
	   //echo $result; exit;
	}

	function sendNotification($registration_ids, $message)
	{
	  // echo '<pre>';	
	  // print_r($registration_ids);exit;
	   $url = 'https://fcm.googleapis.com/fcm/send';
	   $fields = array(
	       'registration_ids' => $registration_ids,
	       'data' => $message
	   );

	   // echo '<pre>';
	   // print_r($fields);exit;
	   $headers = array(
	       'Authorization:key=' . GOOGLE_API_KEY,
	       'Content-Type: application/json'
	   );

	   $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url); 
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   // curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	    $result = curl_exec($ch);
	    curl_close($ch);
	   //print_r($result);exit;
	   //return $result;
	   //$result; 
	}

	function iOSPushNotification($deviceToken,$message,$msg,$type,$message_id)//type = 1 = normal and 2 = App
	{ 

		  $passphrase = " ";
		  $payload['aps'] = array(
		    'alert' => array(
		                  "title"=>$msg,
		                  "body"=>substr($message,0,50)
		                  ),
		    'message_id'=>$message_id,
		    'badge' => 1,
		    'type' => $type,
		    'sound' => 'default'
		  );  

		  $payload = json_encode($payload);
		  //$apnsHost = 'gateway.push.apple.com';  //'gateway.sandbox.push.apple.com';  
		  $apnsHost ='gateway.sandbox.push.apple.com'; 
		  $apnsPort = 2195;
		 
		  //$apnsCert = 'pem/atmcPro.pem';
		   $apnsCert = 'pem/ainaDevelopment.pem';
		  //echo $apnsCert; exit;

		$count1 = count($deviceToken);

		for($i=0;$i < $count1;$i++)
		{ 
		  $streamContext = stream_context_create();
		  
		  stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
		  stream_context_set_option($streamContext, 'ssl', 'passphrase', $passphrase);
		  //stream_context_set_option($streamContext, 'ssl', 'cafile', 'entrust_2048_ca.cer');
		  $apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort,$error,$errorString,60,STREAM_CLIENT_CONNECT,$streamContext);

		     $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', $deviceToken[$i]) . chr(0) . chr(strlen($payload)) . $payload;

		      $result = fwrite($apns, $apnsMessage);
		      $result;
		      
	    } 
		 
		  @socket_close($apns);
		  fclose($apns);
	}
	
	
	
	
	
}

?>
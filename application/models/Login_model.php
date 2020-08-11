<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($email, $password)
    {
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('user_email', $email);
		$this->db->where('password', md5($password));
        $this->db->where('status', 1);
        $query = $this->db->get();
        $user = $query->row();
        $cnt=$query->num_rows();
        if(($cnt)>0){
            return $query->result_array();
        } else {
            return array();
        }
    }
	
	
	function loginMewithotp($email, $otp)
	{
		
		$this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('user_email', $email);
		$this->db->where('otp', $otp);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $user = $query->row();
        $cnt=$query->num_rows();
        if(($cnt)>0){
            return $query->result_array();
        } else {
            return array();
        }
		
	}

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('*');
		$this->db->from('user_register');
        $this->db->where('user_email', $email);
        $this->db->where('status', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return 1;
        } else {
            return 0;
        }
    }

	
	
	function forgotpassword($email)
    {
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('user_email', $email);
		
        $this->db->where('status', 1);
        $query = $this->db->get();
        $user = $query->row();
        $cnt=$query->num_rows();
        if(($cnt)>0){
            return $query->result_array();
        } else {
            return array();
        }
    }
	
	

    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('user_register', $data);

        if($result) {
            return 1;
        } else {
            return 0;
        }
    }
	
	
	

   /*
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->result_array();
    }

    
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows;
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('email'=>$email));
    }

    
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

   
    function lastLoginInfo($userId)
    {
        $this->db->select('BaseTbl.createdDtm');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as BaseTbl');

        return $query->row();
    } */
}

?>
<?php

include_once APPPATH . '/libraries/facebook-php-sdk/src/facebook.php';
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	

    function __construct() {

        parent::__construct(); {
            date_default_timezone_set('Australia/canberra');
            $militime = round(microtime(true) * 1000);
            $datetime = date('Y-m-d h:i:s');
            define('militime', $militime);
            define('datetime', $datetime);

            $this->load->library('session');
        }
    }

    /**
     * Author: Vinod K Maurya
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    // Remap the 404 error functions

	function encrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'fe67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';
        $secret_iv = 'fdd3345455fffgffffhkkyoife67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    function decrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'fe67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';
        $secret_iv = 'fdd3345455fffgffffhkkyoife67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
	
	
	
	function payprocess()
	{
		$this->load->model('User_model');
		$courseid=base64_decode($this->decrypt($_REQUEST['courseid']));
		$data['courseslist'] = $this->User_model->courseslist();
		$data['courseslistByid'] = $this->User_model->courseslistbyid($courseid);
		$data['uname'] = $this->session->userdata('uname');
		$data['email'] = $this->session->userdata('email');
		$data['logid'] = $this->session->userdata('logid');
		
		$course_price=$data['courseslistByid'][0]['course_price'];
		$course_title=$data['courseslistByid'][0]['course_title'];
		$courseid=$courseid;
		$data_session_set = array('course_price' => $course_price, 'course_title' => $course_title,'courseid' =>$courseid);
		$sessrecord = $this->session->set_userdata($data_session_set);
		 
		 $data['course_price'] = $this->session->userdata('course_price');
		 $data['course_title'] = $this->session->userdata('course_title');
		 $data['courseid'] = $this->session->userdata('courseid');
		
		$data['main_content'] = 'payment/payprocess';
        $this->load->view('includes/template', $data);
	}
	
	
	function myaccount()
	{
		
		
		//$this->load->view('payment_success');
		
		$this->load->model('User_model');
		$email = $this->session->userdata('email');
		$data['courseslist'] = $this->User_model->courseslist();

		//$page = ($lasturl) ? $lasturl : 0;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['paymentdetails'] = $this->User_model->paymentdetails($email);
        $count_t = $this->User_model->countOrdersaveData($email);
        $config = array();
        $config['per_page'] = 4;
        $config['full_tag_open'] = '<div class="pagination pagination-small pagination-centered">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = '';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" style="text-align:center"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['start_link'] = '';
        $config['first_link'] = '';
        $config["base_url"] = base_url() . "payment/myaccount/";
        $config["total_rows"] = $count_t;
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);
        $data['paymentlist'] = $this->User_model->countOrderData($email,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['main_content'] = 'payment/myaccount';
        $this->load->view('includes/template', $data);
	}
		
	
	
	
	public function check()
	{
		
		$this->load->model('Order_model');
		//check whether stripe token is not empty
		if(!empty($_POST['stripeToken']))
		{
			
			$course_price = $this->session->userdata('course_price');
			$course_title = $this->session->userdata('course_title');
			$courseid = $this->session->userdata('courseid');
			
			$uname = $this->session->userdata('uname');
			$email = $this->session->userdata('email');
			$logid = $this->session->userdata('logid');
			
			
			//get token, card and user info from the form
			$token  = $_POST['stripeToken'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$card_num = $_POST['card_num'];
			$card_cvc = $_POST['cvc'];
			$card_exp_month = $_POST['exp_month'];
			$card_exp_year = $_POST['exp_year'];
			
			
			
			$today = date("Ymd");
			$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
			$uniqueorderid = $today . $rand;
			
			//include Stripe PHP library
			require_once APPPATH."third_party/stripe/init.php";
			
			
			
			//set api key
			$stripe = array(
			  "secret_key"      => "sk_test_MQtK99opjdELnkTSc0nUvNMn00gvK6Q6vz",
			  "publishable_key" => "pk_test_TpwU7vwXwjDigb4RPdjO90uz006ah4NNtZ"
			);
			
			\Stripe\Stripe::setApiKey($stripe['secret_key']);
			
			//add customer to stripe
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			
			//item information
			$itemName = $course_title;
			$itemNumber = "CI".$uniqueorderid.$courseid;
			$itemPrice = $course_price;
			$currency = "usd";
			$orderID = $uniqueorderid;
			
			//charge a credit or a debit card
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $itemPrice,
				'currency' => $currency,
				'description' => $itemNumber,
				'metadata' => array(
					'item_id' => $itemNumber
				)
			));
			
			//retrieve charge details
			$chargeJson = $charge->jsonSerialize();

			//check whether the charge is successful
			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
			{
				//order details 
				$amount = $chargeJson['amount'];
				$balance_transaction = $chargeJson['balance_transaction'];
				$currency = $chargeJson['currency'];
				$status = $chargeJson['status'];
				$date = date("Y-m-d H:i:s");
			
				
				//insert tansaction data into the database
				/*$dataDB = array(
					'name' => $name,
					'email' => $email, 
					'card_num' => $card_num, 
					'card_cvc' => $card_cvc, 
					'card_exp_month' => $card_exp_month, 
					'card_exp_year' => $card_exp_year, 
					'item_name' => $itemName, 
					'item_number' => $itemNumber, 
					'item_price' => $itemPrice, 
					'item_price_currency' => $currency, 
					'paid_amount' => $amount, 
					'paid_amount_currency' => $currency, 
					'txn_id' => $balance_transaction, 
					'payment_status' => $status,
					'created' => $date,
					'modified' => $date
				); */
				
				
				
				    $dataarray = array();
                    $dataarray['name'] = $uname;
					$dataarray['email'] = $email;
					$dataarray['item_name'] = $itemName;
					$dataarray['item_number'] = $itemNumber;
					$dataarray['item_price'] =$itemPrice;
					$dataarray['item_price_currency'] = $currency;
					$dataarray['txn_id'] = $balance_transaction;
					$dataarray['paid_amount'] = $amount;
					$dataarray['paid_amount_currency'] = $currency;
					$dataarray['payment_status'] = $status;
					$dataarray['ip_address'] = $_SERVER['REMOTE_ADDR']; 
					
					$dataarray['created'] = $date;
					$dataarray['modified'] = $date;
					$insertid = $this->Order_model->orderdetails($dataarray);
				
				

				if ($insertid!='') {
					if($insertid && $status == 'succeeded'){
						$data['insertID'] = $insertid;
						
						$data['main_content'] = 'payment/payment_success';
						$this->load->view('includes/template', $data);
						
						
						$data_session_set = array('insertID' =>  $insertid,'item_number' =>$itemNumber);
						$successid = $this->session->set_userdata($data_session_set);
		 
						$data['insertID'] = $this->session->userdata('insertID');
						
						
						
						redirect('payment/payment_success','refresh');
					}else{
						echo "Transaction has been failed";
					}
				}
				else
				{
					echo "not inserted. Transaction has been failed";
				}

			}
			else
			{
				echo "Invalid Token";
				$statusMsg = "";
			}
		}
	}

	public function payment_success()
	{
		//$this->load->view('payment_success');
		$data['insertID'] = $this->session->userdata('insertID');
		$data['item_number'] = $this->session->userdata('item_number');
		$this->load->model('User_model');
		
		$data['courseslist'] = $this->User_model->courseslist();
		$data['main_content'] = 'payment/payment_success';
        $this->load->view('includes/template', $data);
	}

	public function payment_error()
	{
		//$this->load->view('payment_error');
		$data['main_content'] = 'payment/payment_error';
        $this->load->view('includes/template', $data);
	}

	public function help()
	{
		//$this->load->view('help');
		$data['main_content'] = 'payment/help';
        $this->load->view('includes/template', $data);
	}
	
	
    
	
	
	

    /**
     * This function used to check the user is logged in or not
     */
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	
	public function __construct() {
		
		session_start();
		
		parent::__construct();
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('pagination');
			
		$GLOBALS['zone'] = +6;
		$GLOBALS['currency'] = '$';
	}
	
	public function index()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
				
			$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d h:i:s', strtotime($today . ' - 24 hour'));
			$stop_date = date('Y-m-d h:i:s', strtotime($today . ' + 24 hour'));
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			$transaction = $this->db->query("SELECT * FROM transaction WHERE user_id = '$user_id' AND date_time BETWEEN '$start_date' AND '$stop_date'");
			
			if($transaction->num_rows() < 15)
			{
				$transaction = $this->db->query("SELECT * FROM transaction WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 10");
			}
			
			$data['transaction'] = $transaction;
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('history', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	
	public function check() {		
		if(isset($_SESSION['id']) AND $_SESSION['super_id'] != NULL) {
			
			return true;
		}
		else {
			return false;
		}
	}
	
}

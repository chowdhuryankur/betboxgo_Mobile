<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {
	
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
	
	public function msg()
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
			$data['message'] = $this->db->query("SELECT * FROM message WHERE reciver_id = '$user_id' ORDER BY id DESC");
			
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('support', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function msgShow()
	{
		if($this->check() != false) 
		{
			$msid = $this->uri->segment(3);
			$this->db->update('message', array('status'=>"show"), array('id'=>$msid));
			echo "successfull";
		}
	}
	
	public function panel()
	{
		if($this->check() != false) 
		{
			$value = $this->input->post('inqu');
			$user_id = $_SESSION['id'];
			
			if($value == "inbox")
			{
				$data['message'] = $this->db->query("SELECT * FROM message WHERE reciver_id = '$user_id' ORDER BY id DESC");
				$this->load->view('ajax/inbox', $data);
			}
			
			if($value == "send")
			{
				$data['message'] = $this->db->query("SELECT * FROM message WHERE sender_id = '$user_id' ORDER BY id DESC");
				$this->load->view('ajax/send', $data);
			}
			
			if($value == "compose")
			{
				$this->load->view('ajax/compose');
			}
		}
	}
	
	public function nwmsg()
	{
		if($this->check() != false) 
		{
			$ref = $this->security->xss_clean($this->input->post('refe')); 
			$msg = $this->security->xss_clean($this->input->post('msg')); 
			
			$value = array
			(
				'sender_id' => $_SESSION['id'],
				'reciver_id' => "betboxgo",
				'reference' => $ref,
				'date_time' => $today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60),
				'body' => $msg,
				'status' => "pending"
			);
			
			if($this->db->insert('message', $value))
			{
				echo "Your message was send successfully!";
			}
		}
	}
	
	public function faq()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			$data['faq'] = $this->db->query("SELECT * FROM faq WHERE live = 'yes'");
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('faq', $data);
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

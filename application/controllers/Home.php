<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		
		session_start();
		
		parent::__construct();
		$this->load->database();
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
			
		$GLOBALS['zone'] = +6;
		$GLOBALS['currency'] = '$';
	}
	
	public function page()
	{
		if($this->check() != false) 
		{	
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d', strtotime($today . ' - 24 hour'));
			$stop_date = date('Y-m-d', strtotime($today . ' + 24 hour'));
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			
			// cricket
			$cricket = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'cricket' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
			$data['cricket'] = $cricket;
			
			$cri_total_offer = array();
				
			foreach($cricket->result() as $match) 
			{
				$cri_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS cri_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
			}
		
				
			// FootBall
			$data['football'] = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'footBall' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
			
			$foot_total_offer = array();
					
			foreach($data['football']->result() as $match) 
			{
				$foot_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS foot_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
			}
			
			$data['cri_total_offer'] = $cri_total_offer;
			$data['foot_total_offer'] = $foot_total_offer;
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$data['date'] = "TODAY"; 
			$data['dateShow'] = gmdate(("d F, l"), time()+$GLOBALS['zone']*60*60);
			
			$this->load->view('home', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function index()
	{
		if($this->check() != false) 
		{
			redirect('home/page');
		}
		else
		{
			$this->load->view('index.php');
		}
	}
	
	public function today()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
		
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d', strtotime($today . ' - 6 hour'));
			$stop_date = date('Y-m-d', strtotime($today));
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			
			if($this->uri->segment(4) == 'all' or $this->uri->segment(4) == 'cricket')
			{
				// cricket
				$cricket = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'cricket' AND match.status <> 'complite' AND DATE(match.start_date_time) = '$today' ORDER BY match.start_date_time ASC");
				$data['cricket'] = $cricket;
				
				$cri_total_offer = array();
					
				foreach($cricket->result() as $match) 
				{
					$cri_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS cri_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
				}
				$data['cri_total_offer'] = $cri_total_offer;
			}
			if($this->uri->segment(4) == 'all' or $this->uri->segment(4) == 'football')
			{
				// FootBall
				$data['football'] = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'footBall' AND match.status <> 'complite' AND DATE(match.start_date_time) = '$today' ORDER BY match.start_date_time ASC");
				
				$foot_total_offer = array();
						
				foreach($data['football']->result() as $match) 
				{
					$foot_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS foot_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
				}
				$data['foot_total_offer'] = $foot_total_offer;
			}
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			$data['date'] = "TODAY"; 
			$data['dateShow'] = gmdate(("d F, l"), time()+$GLOBALS['zone']*60*60);
			
			if($this->uri->segment(3) == 'aj')
			{
				$this->load->view('ajax/home', $data);
			}
			if($this->uri->segment(3) == 'pg')
			{
				$data['today'] = "aciveMenu";
				$this->load->view('home', $data);
			}
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function tomorow()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
		
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d', strtotime($today . ' + 1 day'));
			$stop_date = date('Y-m-d', strtotime($today. ' + 1 day'));
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			
			if($this->uri->segment(4) == 'all' or $this->uri->segment(4) == 'cricket')
			{
				// cricket
				$cricket = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'cricket' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date'  ORDER BY match.start_date_time ASC");
				$data['cricket'] = $cricket;
				
				$cri_total_offer = array();
					
				foreach($cricket->result() as $match) 
				{
					$cri_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS cri_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
				}
				$data['cri_total_offer'] = $cri_total_offer;
			}
			if($this->uri->segment(4) == 'all' or $this->uri->segment(4) == 'football')
			{
				// FootBall
				$data['football'] = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'footBall' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
				
				$foot_total_offer = array();
						
				foreach($data['football']->result() as $match) 
				{
					$foot_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS foot_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
				}
				$data['foot_total_offer'] = $foot_total_offer;
			}
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			$data['date'] = "TOMORROW"; 
			$data['dateShow'] = date("d F, l", strtotime($today . ' + 1 day'));
			
			if($this->uri->segment(3) == 'aj')
			{
				$this->load->view('ajax/home', $data);
			}
			if($this->uri->segment(3) == 'pg')
			{
				$this->load->view('tomorrow', $data);
			}
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function live()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
		
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);	
			$nowTime = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			
			if($this->uri->segment(4) == 'all' or $this->uri->segment(4) == 'cricket')
			{
				// cricket
				$cricket = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'cricket' AND match.status <> 'complite' AND match.start_date_time < '$nowTime' ORDER BY match.start_date_time ASC");
				$data['cricket'] = $cricket;
				
				$cri_total_offer = array();
					
				foreach($cricket->result() as $match) 
				{
					$cri_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS cri_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
				}
				$data['cri_total_offer'] = $cri_total_offer;
			}
			if($this->uri->segment(4) == 'all' or $this->uri->segment(4) == 'football')
			{
				// FootBall
				$data['football'] = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'footBall' AND match.status <> 'complite' AND match.start_date_time < '$nowTime' ORDER BY match.start_date_time ASC");
				
				$foot_total_offer = array();
						
				foreach($data['football']->result() as $match) 
				{
					$foot_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS foot_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
				}
				$data['foot_total_offer'] = $foot_total_offer;
			}
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			$data['date'] = "TODAY"; 
			$data['dateShow'] = gmdate(("d F, l"), time()+$GLOBALS['zone']*60*60);
			
			if($this->uri->segment(3) == 'aj')
			{
				$this->load->view('ajax/home', $data);
			}
			if($this->uri->segment(3) == 'pg')
			{
				$data['live'] = "aciveMenu";
				$this->load->view('home', $data);
			}
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function all_match()
	{
		if($this->check() != false) 
		{	
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d', strtotime($today . ' - 24 hour'));
			$stop_date = date('Y-m-d', strtotime($today . ' + 24 hour'));
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			
			// cricket
			$cricket = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'cricket' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
			$data['cricket'] = $cricket;
			
			$cri_total_offer = array();
				
			foreach($cricket->result() as $match) 
			{
				$cri_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS cri_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
			}
		
				
			// FootBall
			$data['football'] = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'footBall' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
			
			$foot_total_offer = array();
					
			foreach($data['football']->result() as $match) 
			{
				$foot_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS foot_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
			}
			
			$data['cri_total_offer'] = $cri_total_offer;
			$data['foot_total_offer'] = $foot_total_offer;
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			$data['date'] = "TODAY"; 
			$data['dateShow'] = gmdate(("d F, l"), time()+$GLOBALS['zone']*60*60);
			
			$this->load->view('ajax/home', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}


	public function cricket()
	{
		if($this->check() != false) 
		{	
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d', strtotime($today . ' - 24 hour'));
			$stop_date = date('Y-m-d', strtotime($today));
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			
			$user_id = $_SESSION['id'];
			
			// cricket
			$cricket = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'cricket' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
			$data['cricket'] = $cricket;
			
			$cri_total_offer = array();
				
			foreach($cricket->result() as $match) 
			{
				$cri_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS cri_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
			}
					
			$data['cri_total_offer'] = $cri_total_offer;
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('ajax/cricket', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function soccer()
	{
		if($this->check() != false) 
		{	
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$start_date = date('Y-m-d', strtotime($today . ' - 24 hour'));
			$stop_date = date('Y-m-d', strtotime($today));
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
					
			// FootBall
			$data['football'] = $this->db->query("SELECT * FROM `match` WHERE match.sporce_typ = 'footBall' AND match.status <> 'complite' AND DATE(match.start_date_time) BETWEEN '$start_date' AND '$stop_date' ORDER BY match.start_date_time ASC");
			
			$foot_total_offer = array();
					
			foreach($data['football']->result() as $match) 
			{
				$foot_total_offer[] =$this->db->query("SELECT SUM(offer_share) AS foot_total_offer FROM `bid_offer_temp` WHERE match_id = '$match->id' ");
			}
			
			$data['foot_total_offer'] = $foot_total_offer;
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('ajax/football', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
 	
	public function check() 
	{
		if(isset($_SESSION['id']) AND $_SESSION['super_id'] != NULL) {
			
			return true;
		}
		else {
			return false;
		}
	}
	
	public function log_out() {
		
		/*$this->load->library('user_agent');
					if ($this->agent->is_browser())
					{
    					$agent = $this->agent->browser().' '.$this->agent->version();
					}
					elseif ($this->agent->is_robot())
					{
    					$agent = $this->agent->robot();
					}
					elseif ($this->agent->is_mobile())
					{
    					$agent = $this->agent->mobile();
					}
					else
					{
    					$agent = 'Unidentified User Agent';
					}*/
		
		if(isset($_SESSION['id']))
		{			
		/*$value = array(
			'user_id' => $_SESSION['id'],
			'type' => 'Loged Out',
			'date_time' =>  gmdate(("Y-m-d H:i:s"), time()+$GLOBALS['zone']*60*60),
			'details' => $this->agent->platform().'*'.$agent.'*'.$this->get_user_ip(),
			);*/
				
				session_destroy();
				redirect ('user/log_in');
		}
		else
		{
			session_destroy();
			redirect ('user/log_in');
		}
	
	}
	
	
}

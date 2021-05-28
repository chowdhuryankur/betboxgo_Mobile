<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
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
	
	public function profile()
	{
		if($this->check() != false) 
		{			
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('profile', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function log_in()
	{
		$data = array();
		if($this->uri->segment(3) == "success") {$data['msz'] = "Verefication Complete";}
		
		$this->load->view('login.php', $data);
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
	
	public function panel()
	{
		if($this->check() != false) 
		{
			$value = $this->input->post('inqu');
			$user_id = $_SESSION['id'];
			
			if($value == "pincode")
			{
				$usr = $this->db->query("SELECT pin_code, securityQuestion FROM `user` WHERE id = '$user_id'");
				$data['user'] = $usr->row(0);
				$this->load->view('ajax/pincode', $data);
			}
			
			if($value == "banklist")
			{
				$data['bank'] = $query = $this->db->query("SELECT * FROM `bank`");
				$data['banklist'] = $this->db->query("SELECT * FROM withdraw_setting WHERE user_id = '$user_id' AND typ = 'bank' ORDER BY ID DESC");
				$this->load->view('ajax/banklist', $data);
			}
			
			if($value == "mobile")
			{
				$this->load->model('usr');
				$data['usr_mob_no'] = $this->usr->get_mobile_no($user_id);
				$data['wallet'] = $query = $this->db->query("SELECT * FROM `mob_wallet`");
				$data['mobile'] = $this->db->query("SELECT * FROM withdraw_setting WHERE user_id = '$user_id' AND typ = 'mobile' ORDER BY id DESC");
				$this->load->view('ajax/mobilelist', $data);
			}
		}
	}
	
	public function setting()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('setting', $data);
		}
		else
		{
			redirect('user/log_in');
		}
	}
	public function bnkChange()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$curBnk = $this->security->xss_clean($this->input->post('curBnk'));
			$bkId = $this->security->xss_clean($this->input->post('bkId'));
			
			if($this->db->update('withdraw_setting', array('ac_no'=>$curBnk), array('id'=>$bkId, 'user_id'=>$user_id)))
			{
				echo "successfull";
			}
		}
	}
	
	public function mobChange()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$this->load->model('usr');
			$usr_mob_no = $this->usr->get_mobile_no($user_id);
			
			$curMob = $this->security->xss_clean($this->input->post('curMob'));
			$mbId = $this->security->xss_clean($this->input->post('mbId'));
			
			$no = substr($usr_mob_no,3,14).$curMob;
			
			if($this->db->update('withdraw_setting', array('ac_no'=>$no), array('id'=>$mbId, 'user_id'=>$user_id)))
			{
				echo "successfull";
			}
		}
	}
	
	public function bnkdelet()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$bkId = $this->security->xss_clean($this->uri->segment(3));
			
			$this->db->delete('withdraw_setting', array('id' => $bkId,'user_id'=>$user_id));
			{
				echo "successfull";
			}
		}
	}
	
	public function mobdelet()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$mbId = $this->security->xss_clean($this->uri->segment(3));
			
			$this->db->delete('withdraw_setting', array('id' => $mbId,'user_id'=>$user_id));
			{
				echo "successfull";
			}
		}
	}
	
	public function nwBank()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$bnkAc = $this->security->xss_clean($this->input->post('bnkAc'));
			$bnkName = $this->security->xss_clean($this->input->post('bnkName'));
			
			if($bnkAc != NULL and $bnkName != NULL)
			{
				$value = array
				(
					'user_id' => $user_id,
					'withdra' => $bnkName,
					'ac_no' => $bnkAc,
					'typ' => 'bank',
				);
				
				if($this->db->insert('withdraw_setting', $value))
				{
					echo $this->db->insert_id();
				}
				else
				{
					echo "unsuccess";
				}
			}
		}
	}
	
	public function nwMob()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$mobAc = $this->security->xss_clean($this->input->post('mobAc'));
			$mobName = $this->security->xss_clean($this->input->post('mobName'));
			
			if($mobName != NULL)
			{
				$this->load->model('usr');
				$usr_mob_no = $this->usr->get_mobile_no($user_id);
				$no = substr($usr_mob_no,3,14);
				
				$value = array
				(
					'user_id' => $user_id,
					'withdra' => $mobName,
					'ac_no' => $no.$mobAc,
					'typ' => 'mobile',
				);
				
				if($this->db->insert('withdraw_setting', $value))
				{
					echo $this->db->insert_id();
				}
				else
				{
					echo "unsuccess";
				}
			}
		}
	}
	
	public function update()
	{
		if($this->check() != false) 
		{	
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$user_id = $_SESSION['id'];
			$this->load->model('usr');
			$this->load->helper('email');
			
			$fild = $this->security->xss_clean($this->uri->segment(3));
			$value = $this->security->xss_clean($this->uri->segment(4));
			
			if($this->uri->segment(5) != NULL)
			{
				$pin = $this->security->xss_clean($this->uri->segment(5));
			}
			
			if($fild == "name") 
			{
				if($this->user->verification_status($user_id) == 'no')
				{ 
					$name = explode(" ", $value);
					$this->db->update('user', array('fs_name'=>$name[0],'ls_name'=>$name[1]), array('id'=>$user_id));
					echo "successfull";
				}
			}
			if($fild == "dob") 
			{
				if($this->usr->verification_status($user_id) == 'no')
				{ 
					$dob = date_format(date_create($value),"Y-m-d");
					$this->db->update('user', array('dob'=>$dob), array('id'=>$user_id));
					echo "successfull";
				}
			}
			if($fild == "email") 
			{
				$email = $value;
				if(valid_email($email) and $this->usr->is_unique('email',$email))
				{
					if($this->usr->get_pin($user_id) == $pin)
					{
						$this->db->update('user', array('email'=>$email), array('id'=>$user_id));
						echo "successfull";
					}
					else
					{
						echo "wrongpin";
					}
				}
				else
				{
					echo "wrongemail";
				}
			}
			if($fild == "mobile") 
			{
				$mobile = $value;
				if($this->usr->is_unique('mobile',$mobile))
				{
					if($this->usr->get_pin($user_id) == $pin)
					{
						$this->db->update('user', array('mobile'=>$mobile), array('id'=>$user_id));
						echo "successfull";
					}
					else
					{
						echo "wrongpin";
					}
				}
				else
				{
					echo "wrongnum";
				}
			}
			if($fild == "password") 
			{
				$nwPass = $value;
				if($this->usr->get_pin($user_id) === $pin)
				{
					$this->db->update('user', array('password'=> md5($nwPass)), array('id'=>$user_id));
					echo "successfull";
				}
				else
				{
					echo "wrongpin";
				}
			}
		}
	}
	
	public function pinChange()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$user = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");
			$usr = $user->row(0);
			$curPin = $this->security->xss_clean($this->input->post('curPin'));
			$nwPin = $this->security->xss_clean($this->input->post('nwPin'));
			$qsAnswer = $this->security->xss_clean($this->input->post('qsAnswer'));
			
			if($usr->group != "suspend")
			{
				if($usr->pin_code == $curPin)
				{
					if(strlen($nwPin) == 4)
					{
						if($usr->securityAns == $qsAnswer)
						{
							$this->db->update('user', array('pin_code'=>$nwPin), array('id'=>$user_id));
							echo "successfull";
						}
						else
						{
							echo "wrongans";
						}
					}
					else
					{
						echo "wronglength";
					}
				}
				else
				{
					echo "wrongpin";
				}
			}
			else
			{
				echo "suspend";
			}
		}
	}
	
	public function registation()
	{
		$data['questions'] = $this->db->query("SELECT * FROM secquestion WHERE status = 'live'");	
		$this->load->view('registation', $data);
	}
	
	public function email_exists()
	{
		if($this->input->post('email') != NULL)
		{
			$email = $this->input->post('email');
		}
		else
		{
			$email = $this->uri->segment(3);
		}
		
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		
		if($query->num_rows() > 0)
		{ 
			echo "false"; 
		} 
		else 
		{ 
			echo "true";  
		}
	}
	
	public function username_exists()
	{
		if($this->input->post('username') != NULL)
		{
			$username = $this->input->post('username');
		}
		else
		{
			$username = $this->uri->segment(3);
		}
		
		$this->db->where('user_name', $username);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{ 
			echo "false"; 
		} 
		else { 
			echo "true";  
		}
	}
	
	public function contact_exists()
	{
		$contact = '+88';
		if($this->input->post('contact2') != NULL)
		{
			$contact .= $this->input->post('contact2');
		}
		else
		{
			$contact .= $this->uri->segment(3);
		}
		
		$this->db->where('mobile', $contact);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{ 
			echo json_encode(array('valid' => false)); 
		} 
		else { 
			echo json_encode(array('valid' => true));  
		}
	}

	public function new_user()
	{
		$this->form_validation->set_rules('country', 'country', 'trim|strip_tags|xss_clean|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|strip_tags|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('holdingNo', 'Holding Number & Name', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('stAddress', 'Street Addres', 'trim|strip_tags|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|strip_tags|xss_clean|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('con_email', 'Confirm Email Address', 'trim|strip_tags|xss_clean|matches[email]');
		$this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required|strip_tags|xss_clean|min_length[11]|max_length[14]');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|strip_tags|xss_clean|min_length[4]|max_length[10]|is_unique[user.user_name]');
		$this->form_validation->set_rules('psd', 'password', 'trim|strip_tags|xss_clean|required');
		$this->form_validation->set_rules('con_password', 'Confurm Password', 'xss_clean|strip_tags|matches[psd]');
		$this->form_validation->set_rules('securityQuestion', 'Set Security Question', 'trim|strip_tags|xss_clean');
		$this->form_validation->set_rules('securityAns', 'Set your answer', 'trim|strip_tags|xss_clean');
		
		if($this->input->post('ref_code') != NULL) 
		{ 
			$this->form_validation->set_rules('ref_code', 'Reference', 'trim|strip_tags|xss_clean|callback_is_exsis');
			$reference = $this->input->post('ref_code'); 
		} 
		else
		{ 
			$this->form_validation->set_rules('ref_code', 'Reference', 'trim|strip_tags|xss_clean');
			$reference = "no"; 
		}
		
		$this->form_validation->set_error_delimiters('<span class="err">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['country'] = $this->input->post('country', true);
			$data['title'] = $this->input->post('title', true); 
			$data['first_name'] = $this->input->post('first_name', true); 
			$data['last_name'] = $this->input->post('last_name', true); 
			$data['gender'] = $this->input->post('gender', true); 
			$data['dob'] = $this->input->post('dob', true); 
			$data['holdingNo'] = $this->input->post('holdingNo', true);
			$data['stAddress'] = $this->input->post('stAddress', true);
			$data['city'] = $this->input->post('city', true);
			$data['postcode'] = $this->input->post('postcode', true);
			$data['email'] = $this->input->post('email', true);
			$data['con_email'] = $this->input->post('con_email', true);
			$data['contactno'] = $this->input->post('contactno', true);
			$data['username'] = $this->input->post('username', true);
			$data['securityQuestion'] = $this->input->post('securityQuestion', true);
			$data['securityAns'] = $this->input->post('securityAns', true);
			$data['ref_code'] = $this->input->post('ref_code', true);
			
			$data['questions'] = $this->db->query("SELECT * FROM secquestion WHERE status = 'live'");			
			$this->load->view('registation', $data);
		}
		else
		{
			$this->db->trans_start();
			$time = gmdate(("Y-m-d H:i:s"), time()+$GLOBALS['zone']*60*60);			
			$mobile = "+88".$this->input->post('contactno');
			$dob = date_create($this->input->post('dob'));
			$dob = date_format($dob, "Y-m-d");
			$super_id = $this->super_id();
			$digits = 4;
			$sms_code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
			
			$value = array
			(
			'super_id' => $super_id,
			'title' => $this->input->post('title', true),
			'fs_name' => $this->input->post('first_name', true),
			'ls_name' => $this->input->post('last_name', true),
			'house' => $this->input->post('holdingNo', true),
			'city' => $this->input->post('city', true),
			'stAddress' => $this->input->post('stAddress', true),
			'zip' => $this->input->post('postcode', true),
			'country' => $this->input->post('country', true),
			'email' => $this->input->post('email', true),
			'mobile' => $mobile,
			'dob' => $dob,
			'pin_code' => $sms_code,
			'user_name' => $this->input->post('username', true),
			'password' => md5($this->input->post('password')),
			'securityQuestion' => $this->input->post('securityQuestion', true),
			'securityAns' => $this->input->post('securityAns', true),
			'reference' => $reference,
			'reg_time' => $time,
			'update_time' => $time,
			'status' => 'inactive',
			'verified' => 'no',
			'type' => 'Easy'
			);
			
			if($this->db->insert('user', $value))
			{
				$cus_id = $this->db->insert_id();
				$this->db->insert('balance', array('user_id' => $cus_id, 'dabit_amount' => 00.00, 'betting_amount' => 00.00, 'remaning_amount' => 00.00, 'update_time' => $time));
				
				//$this->load->library('sms');
				
				$name = $this->input->post('title', true).$this->input->post('first_name', true).' '.$this->input->post('last_name', true);
				$mobile = $this->input->post('contact', true).$this->input->post('contact', true);
				
				$this->load->library('encryption');
				$link1 = base_url().'user/email_verify/'.$this->encryption->encrypt($super_id);
				$link = "<br /><a target='_new' href='".$link1."'>". $link1. "</a></body></html> ";
				
				$message = "<html><body> Dear ".$name."<br /> Please click on bellow link or copy and past the link in to your browser and verify your email address. \n".$link;
				
				$sms = "Welcome to BetBoxGo.com 
Your registration has completed. To activate your account please use this code: $sms_code. Good Luck!";
				$reciver = $this->input->post('email');
				//$this->sendmail($reciver, $message);
				//$this->sms->sending_sms_single($mobile, $sms);
				$this->db->trans_complete();
								
				redirect('user/verefy/'.$cus_id);
				
			}
			else
			{
				$data['msz'] = "Something Wrong Please Try Again!";
				$data['questions'] = $this->db->query("SELECT * FROM secquestion WHERE status = 'live'");
				$this->load->view('registation', $data);
			}
			
		}
	}
	
	public function verefy()
	{
		$cus_id = $this->uri->segment(3);
		$this->load->model('usr');
		
		if($this->usr->status($cus_id) == 'inactive') 
		{
			$data['cus_id'] = $cus_id;
			$this->load->view('verifi', $data);
		}
		else
		{
			$this->load->view('ajax/already_vfy');
		}
	}
		
	public function super_id()
	{
		$query = $this->db->query('SELECT super_id FROM user');
		$query_no = mt_rand(2,999);
		$num = $query->num_rows();
		$sid = $query_no;
		if($num < 9)
		{
			$num = $num+1;
			$sid = $sid.'00'.$num;
		}
		else if($num >= 9 AND $num < 99) 
		{ 
			$num = $num+1;
			$sid = $sid.'0'.$num;
		}
		else if($num >= 99 AND $num < 999)
		{
			$num = $num+1;
			$sid = $sid.$num;
		}
		else if($num >= 999 AND $num < 9999)
		{
			$num = $num+1;
			$sid = $sid.$num;
		}
		else
		{
			$num = $num+1;
			$sid = $sid.$num;
		}
		
		return $sid;
	}
	
	public function email_verify()
	{
		$link = $this->uri->segment(3);
		$todate = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
		$super_id = $this->decode($link);
		$query = $this->db->query("SELECT id, status, verified FROM user WHERE super_id = '$super_id'");
		$query1 = $query->row(0);
		if($query->num_rows() > 0) {
			
			if($query1->verified == 'no') {
			if($this->db->update('user', array('status' => 'active', 'verified' => 'by email'), array('id' => $query1->id)))
			{
				$body = "Welcome to BETBOXGO. Your contribution and suggestions will consider with respect for your better betting experience. Enjoy Betting at BETBOXGO.COM Thank You.";
				$this->db->insert('message', array('sender_id' => 'BETBOXGO', 'reciver_id' => $query1->id, 'date_time' => $todate, 'body' => $body, 'status' => 'pending'));
				
				redirect('user/log_in/emvfy');
			}
			}
			else
			{
				$data['msz'] = "You are already verified!";
				$this->load->view('log_in', $data);
			}
		}
		else
		{
			$data['msz'] = "invalid process!";
			$this->load->view('log_in', $data);
		}
	}
	
	public function verefication()
	{
		$cus_id = $this->uri->segment(3);
		$query = $this->db->query("SELECT * FROM user WHERE id = '$cus_id'");
		$data['user'] = $query->row(0);
		
		if($data['user']->status == 'inactive') 
		{
			$data['cus_id'] = $cus_id;
			$this->load->view('verifi', $data);
		}
		else
		{
			redirect('user/log_in');
		}
	}
	
	public function check_code()
	{
		$code = $this->input->post('code');
		$user_id = $this->input->post('ssid');
		
		$query = $this->db->query("SELECT pin_code, status FROM user WHERE id = '$user_id'");
		$user = $query->row(0);

		if($user->status == "inactive") 
		{
			if($user->pin_code == $code)
			{
				if($this->db->update('user', array('status'=>'active','verified'=>'by sms','pin_code'=>''), array('id' => $user_id)))
				{
					$todate = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
					$body = "Welcome to betboxgo. Your contribution and suggestions will consider with respect for your better betting experience. Enjoy Betting at betboxgo.com Thank You.";
				
					$this->db->insert('message', array('sender_id' => 'betboxgo', 'reciver_id' => $user_id, 'date_time' => $todate, 'body' => $body, 'status' => 'pending'));
					
						
					redirect('user/log_in/success');
				}
			}
			else
			{
				$data['cus_id'] = $user_id;
				$data['msz'] = "Wrong Code";
				$this->load->view('verifi', $data);
			}
		}
		if($user->status == "active") 
		{
			redirect('user/log_in');
		}
	}
	
	function is_exsis($str) 
	{
    	$queryu = $this->db->query("SELECT id FROM user WHERE super_id = '$str'");
		
		if( $queryu->num_rows() > 0 )
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('is_exsis', 'The %s field not a valid ID for Reference!');
			return false;
		}
	}
		
	public function sign_in()
	{	
		$this->form_validation->set_rules('usrname', 'username', 'trim|required|max_length[10]|strip_tags|xss_clean');
		$this->form_validation->set_rules('psw', 'password', 'trim|required|md5');
		
		$this->form_validation->set_error_delimiters('<span class="err">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			redirect('user/log_in');
		}
		else
		{
			$user = $this->input->post('usrname', true);
			$pass = $this->input->post('psw', true);
			
			$query = $this->db->query("SELECT * FROM user WHERE user_name = '$user' AND password = '$pass'");
			
			if($query->num_rows() > 0) 
			{
				$user = $query->row(0);
				
				if($user->status == 'active')
				{
					if($user->group == 'block')
					{
						session_destroy();
						redirect('user/log_in');
					}
					else
					{
						$_SESSION['id'] = $user->id;
						$_SESSION['super_id'] = $user->super_id;
						$_SESSION['user_name'] = $user->user_name;
						$_SESSION['type'] = $user->type;
						
						redirect('home/page');
					}
				}
				else
				{
					redirect('user/verefication/'.$user->id);
				}
			}
			else
			{
				$data['msz'] = "Wrong usermane or password";
				$this->load->view('login', $data);
			}
		}
		
	}
	
 	public function betboxid()
	{
		if($this->check() != false) 
		{
			$user = $this->input->post('boxid');
			
			if($_SESSION['super_id'] != $user)
			{
				$query = $this->db->query("SELECT id, user_name FROM `user` WHERE super_id = '$user'");
				$data['currency'] = $GLOBALS['currency'];
			
				if($query->num_rows() > 0)
				{
					$data['receiver'] = $query->row();
					$this->load->view('ajax/find_user', $data);
				}
				else
				{
					echo '<span class="w3-col s12 m12 w3-center w3-padding">Sorry! No account found.</span>';
				}
			}
			else
			{
					echo '<span class="level_color1">Your Own ID! </span>';
			}
		}
		else
		{
			redirect('user/log_in');
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

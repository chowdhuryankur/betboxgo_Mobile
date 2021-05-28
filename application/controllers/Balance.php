<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Balance extends CI_Controller {
	
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
	
	public function cash_in()
	{
		if($this->check() != false) 
		{	
			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			$data['bkash'] = 'clean';
			$data['Nagad'] = 'clean';
			$data['Roket'] = 'clean';
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
		//	bkash
			$chk_bkash = $this->db->query("SELECT id FROM deposit WHERE user_id = '$_SESSION[id]' AND status = 'Processing' AND method = 'bkash'");
			if($chk_bkash->num_rows() > 0)
			{
					$data['bkash'] = 'wait';
			}
			else
			{
				$bkno_agent = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'bkash' AND status = 'runing' AND service_type = 'Agent'");
				$data['bkno_agent'] = $bkno_agent->row(0);
				$bkno_personal = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'bkash' AND status = 'runing' AND service_type = 'Personal'");
				$data['bkno_personal'] = $bkno_personal->row(0);
			}
			
		//	Nagad	
			$chk_nagad = $this->db->query("SELECT id FROM deposit WHERE user_id = '$_SESSION[id]' AND status = 'Processing' AND method = 'nagad'");
			if($chk_nagad->num_rows() > 0)
			{
				$data['Nagad'] = 'wait';
			}
			else
			{
				$nagad_agent = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Nagad' AND status = 'runing' AND service_type = 'Agent'");
				$data['nagad_agent'] = $nagad_agent->row(0);
				$nagad_personal = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Nagad' AND status = 'runing' AND service_type = 'Personal'");
				$data['nagad_personal'] = $nagad_personal->row(0);
			}	
		//	roket	
			$chk_roket = $this->db->query("SELECT id FROM deposit WHERE user_id = '$_SESSION[id]' AND status = 'Processing' AND method = 'roket'");
			if($chk_roket->num_rows() > 0)
			{
				$data['Roket'] = 'wait';
			}
			else
			{
				$Rkno_agent = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Roket' AND status = 'runing' AND service_type = 'Agent'");
				$data['Rkno_agent'] = $Rkno_agent->row(0);
				$Rkno_personal = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Roket' AND status = 'runing' AND service_type = 'Personal'");
				$data['Rkno_personal'] = $Rkno_personal->row(0);
			}
						
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('deposit', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function cash_out()
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
			
			$data['bank'] = $query = $this->db->get_where('withdraw_setting', array('user_id' => $user_id,'typ' => 'bank'));
			$data['mobile'] = $query = $this->db->get_where('withdraw_setting', array('user_id' => $user_id,'typ' => 'mobile'));
			
			$rn_withdr = $query = $this->db->get_where('withdraw', array('user_id' => $user_id,'status' => 'pending'));
			
			$with_to = array();
			foreach($rn_withdr->result() as $res) 
			{
				array_push($with_to, $res->ac_no); 
			}
			
			$data['with_to'] = $with_to;
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('withdraw', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function add_withdraw()
	{
		if($this->check() != false) 
		{
			$this->load->model('balan');
			$this->load->model('setting');
			
			$user_id = $_SESSION['id'];
			$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
			
			$typ = $this->security->xss_clean($this->input->post('typ'));
			$number = $this->security->xss_clean($this->input->post('number'));
			$amount = $this->security->xss_clean($this->input->post('amount'));
			$pin = $this->security->xss_clean($this->input->post('pin'));
			
			$user = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");		
			$usr = $user->row(0);
			
			if($typ == 'b') { $typ = 'bank'; $limit = $this->setting->bank_limit($usr->type); } 
			if($typ == 'm') { $typ = 'mobile'; $limit = $this->setting->mobile_limit($usr->type); }
			
			$with_seting = $this->db->query("SELECT * FROM withdraw_setting WHERE user_id = '$user_id' AND ac_no = '$number' AND typ = '$typ' ");
			
			if($with_seting->num_rows() > 0)
			{
				$with = $with_seting->row(0);
				
				if($usr->group != 'suspend')
				{
					if($limit >= $amount and $this->balan->remaning_amount($user_id) >= $amount)
					{						
						if($usr->pin_code === $pin)
						{
							$this->db->trans_start();
							$this->balan->withdraw_balance($user_id, $amount);
							$vlue = array
							(
								'user_id' => $user_id,
								'request_amount' => $amount,
								'withdraw_to' => $with->withdra,
								'method' => $typ,
								'ac_no' => $number,
								'status' => 'pending',
								'request_date' => $today,
							);
							$tran = array
							(
								'date_time' => $today,
								'user_id' => $user_id,
								'category' => 'WITHDRAW',
								'source' => $with->id,
								'amount' => $amount,
								'amount_statue' => 'minus',
								'fee' => '0',
								'balance' => $this->balan->dabit_amount($user_id),
							);
							
							if($this->db->insert('withdraw', $vlue))
							{
								$this->db->insert('transaction', $tran);
								$this->db->trans_complete();
								echo 'success';
							}
						}
						else
						{
							echo 'wrong pin';
						}
					}
					else
					{
						echo 'wrong amount';
					}
				}
				else
				{
					echo 'account suspended';
				}
			}
			else
			{
				echo 'wrong data';
			}
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function transfer()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			
			
			$this->load->model('balan');
			$this->load->model('usr');
			$this->load->model('setting');
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
				
			if($this->usr->user_group($user_id) != 'suspend' and $this->usr->trns_status($user_id) == 'on') 
			{
				$data['trns_send'] = $this->balan->balance_trns_count($user_id,date('m'),date('Y'));
				$data['limit'] = $this->setting->bl_tran_limit($_SESSION['type']);
				$data['trns_fee'] = $this->setting->bl_tran_fee();
			}
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('transfer', $data);
		}
		else
		{
			redirect('main/log_in');
		}
	}
	
	public function bl_transfer()
	{
		if($this->check() != false) 
		{
			$this->form_validation->set_rules('rid', 'rid', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tns_amount', 'amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pin', 'pin', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
			{
				$uid = $_SESSION['id'];
				$rid = $this->input->post('rid');
				$tns_amount = $this->input->post('tns_amount');
				$pin = $this->input->post('pin');
				$fee = 0;
				
				
				$this->load->model('balan');
				$this->load->model('usr');
				$this->load->model('setting');
				$this->load->model('transaction');
				
				if($this->usr->trns_status($uid) != "off" and $this->usr->user_group($uid) != "suspend")
				{
					$rec_superid = $this->usr->get_super_id($rid);
					$rsen_superid = $this->usr->get_super_id($uid);
					
					$this->db->trans_start();
					$trns_send = $this->balan->balance_trns_count($uid,date('m'),date('Y'));
					$limit = $this->setting->bl_tran_limit($_SESSION['type']);
					$fee = 0;
					if($limit->status <= $trns_send)
					{
						$trns_fee = $this->setting->bl_tran_fee();
						$fee = $tns_amount * $trns_fee;
					}
					$sender_remaning_amount = $this->balan->remaning_amount_lok($uid);
					$sender_deposit_amount = $this->balan->deposit_amount($uid);
					$max_tns_amount = $sender_remaning_amount*$limit->location;
					
					if($max_tns_amount > $tns_amount)
					{
						if($pin == $this->usr->get_pin($uid))
						{
							$transfer_amount = $tns_amount + $fee;
							$remaning_balance = $sender_remaning_amount - $transfer_amount;
							$deposit_amount = $sender_deposit_amount - $transfer_amount;
							$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
							
							$valuebl = array
							(
								'dabit_amount' => $deposit_amount,
								'remaning_amount' => $remaning_balance,
								'update_time' => $today,
							);
							
							if($this->balan->update_balance($uid, $valuebl))
							{
								$valu_sender = array
								(
									'date_time' => $today,
									'user_id' => $uid,
									'category' => 'TRANSFER',
									'source' => $rid,
									'first_vl' => 'Account',
									'second_vl' => $rec_superid,
									'amount' => $tns_amount,
									'amount_statue' => '-',
									'fee' => $fee,
									'balance' => $deposit_amount,
								);
								
								if($this->transaction->add_transaction($valu_sender))
								{
									$this->balan->add_amount($rid, $tns_amount);
								}
								
								$valu_recever = array
								(
									'date_time' => $today,
									'user_id' => $rid,
									'category' => 'TRANSFER',
									'source' => $uid,
									'first_vl' => 'Account',
									'second_vl' => $rsen_superid,
									'amount' => $tns_amount,
									'amount_statue' => '+',
									'fee' => '00.00',
									'balance' => $tns_amount+$this->balan->deposit_amount($rid),
								);
								
								$this->transaction->add_transaction($valu_recever);
								$this->db->trans_complete();
								echo "<span>$".$tns_amount." was successfully transfered </span>";
							}
							else
							{
								$this->db->trans_complete();
								echo "Sorry! Try again";
							}
						}
						else
						{
							$this->db->trans_complete();
							echo "Wrong Pin";
						}
					}
					else
					{
						$this->db->trans_complete();
						echo "Sorry amount cross the limit.";
					}
				}
				else
				{
					echo "Sorry you are not allow for transfer balance!";
				}
				
			}
			else
			{
				echo "Pleae enter valid information.";
			}
		}
		else
		{
			session_destroy();
			echo "Session out. Please login.";
		}
	}
	
	public function add_deposit()
	{
		if($this->check() != false) 
		{
			$this->form_validation->set_rules('dollar', 'dollar', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bdt', 'bdt', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sender_no', 'sender_no', 'trim|required|xss_clean');
			$this->form_validation->set_rules('trxid', 'trxid', 'trim|xss_clean');
			$this->form_validation->set_rules('number', 'number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('num_typ', 'num_typ', 'trim||required|xss_clean');
			$this->form_validation->set_rules('method', 'method', 'trim||required|xss_clean');
			
			$bdt = $this->input->post('bdt');
			$typ = $this->input->post('num_typ');
			
			if($this->input->post('method')=='bk') { $method = 'bkash'; }
			if($this->input->post('method')=='rk') { $method = 'roket'; }
			if($this->input->post('method')=='ng') { $method = 'nagad'; }
			
			if($typ == "personal")
			{
				$bk_ch = ($bdt/100)*2;
				$t_bdt = $bdt - $bk_ch;
				$dollar = $t_bdt / 80;
			}
			else
			{
				$bk_ch = 0;
				$dollar = $bdt / 80;
			}
			
				$vlue = array(
				'user_id' => $_SESSION['id'],
				'dollar' => $dollar,
				'bdt' => $this->input->post('bdt'),
				'date' => gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60),
				'status' => 'Processing',
				'coment' => $typ.' BDT: '.$bdt. ' Dollar: '.$dollar,
				'mobmoney' => $this->input->post('number'),
				'sender_no' => $this->input->post('sender_no').'/'.$this->input->post('trxid'),
				'method' => $method,
				);
				
				if($this->db->insert('deposit', $vlue))
				{
					$this->load->view('ajax/dep_proce'); 
				}
				else
				{
					echo "some wrong";
				}
		}
		else 
		{
			redirect('main/log_in');
		}
	}
	
	public function panel()
	{
		if($this->check() != false) 
		{
			$value = $this->input->post('inqu');
			$user_id = $_SESSION['id'];
			
			if($value == 'cash_in')
			{
				$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
				$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
				$data['bkash'] = 'clean';
				$data['Nagad'] = 'clean';
				$data['Roket'] = 'clean';
				$user_id = $_SESSION['id'];
				
				$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
				$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
				
				$chk_bkash = $this->db->query("SELECT id FROM deposit WHERE user_id = '$user_id' AND status = 'Processing' AND method = 'bkash'");
				if($chk_bkash->num_rows() > 0)
				{
					$data['bkash'] = 'wait';
				}
				else
				{
					$bkno_agent = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'bkash' AND status = 'runing' AND service_type = 'Agent'");
					$data['bkno_agent'] = $bkno_agent->row(0);
					$bkno_personal = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'bkash' AND status = 'runing' AND service_type = 'Personal'");
					$data['bkno_personal'] = $bkno_personal->row(0);
				}
					
				$chk_nagad = $this->db->query("SELECT id FROM deposit WHERE user_id = '$_SESSION[id]' AND status = 'Processing' AND method = 'nagad'");
				if($chk_nagad->num_rows() > 0)
				{
					$data['Nagad'] = 'wait';
				}
				else
				{
					$nagad_agent = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Nagad' AND status = 'runing' AND service_type = 'Agent'");
					$data['nagad_agent'] = $nagad_agent->row(0);
					$nagad_personal = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Nagad' AND status = 'runing' AND service_type = 'Personal'");
					$data['nagad_personal'] = $nagad_personal->row(0);
				}	
					
				$chk_roket = $this->db->query("SELECT id FROM deposit WHERE user_id = '$_SESSION[id]' AND status = 'Processing' AND method = 'roket'");
				if($chk_roket->num_rows() > 0)
				{
						$data['Roket'] = 'wait';
				}
				else
				{
					$Rkno_agent = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Roket' AND status = 'runing' AND service_type = 'Agent'");
					$data['Rkno_agent'] = $Rkno_agent->row(0);
					$Rkno_personal = $this->db->query("SELECT id, sim_number FROM mobmoney WHERE oparetor = 'Roket' AND status = 'runing' AND service_type = 'Personal'");
					$data['Rkno_personal'] = $Rkno_personal->row(0);
				}
							
				$data['currency'] = $GLOBALS['currency'];
				$data['zone'] = $GLOBALS['zone'];
					
				$this->load->view('ajax/cash_in', $data);
			}
			if($value == 'inqueue')
			{
				$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
				$start_date = date('Y-m-d', strtotime($today . ' - 1 day'));
				$stop_date = date('Y-m-d', strtotime($today . ' + 1 day'));
				
				$data['deposit'] = $this->db->query("SELECT * FROM `deposit` WHERE status = 'Processing' AND user_id = '$user_id' ORDER BY `id` ASC");
				
				$this->load->view('ajax/inqueue', $data);
			}
			if($value == 'inhistory')
			{
				$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
				
				$depo_date = $this->db->query("SELECT * FROM `deposit` WHERE status <> 'Processing' AND user_id = '$user_id' ORDER BY `id` DESC LIMIT 15");
				
				if($depo_date->num_rows() > 0)
				{
					$end_date = $depo_date->first_row();
					$data['end_date'] = $end_date->date;
					$start_date = $depo_date->last_row();
					$data['start_date'] = $start_date->date;
					$data['deposit'] = $depo_date;
				}
				else
				{
					$data['end_date'] = NULL;
					$data['start_date'] = NULL;
					$data['today'] = $today;
					$data['deposit'] = NULL;
				}
				
				$this->load->view('ajax/deposit_history', $data);
			}
		}
		else 
		{
			redirect('main/log_in');
		}
	}
	
	public function hissearch()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
			$stdate = date('Y-m-d', strtotime($this->uri->segment(3)));
			$eddate = date('Y-m-d', strtotime($this->uri->segment(4)));
			
			$depo_date = $this->db->query("SELECT * FROM `deposit` WHERE status <> 'Processing' AND user_id = '$user_id' AND DATE('date') BETWEEN '$stdate' AND '$eddate' ORDER BY `id` DESC");
				
			if($depo_date->num_rows() > 0)
				{
					$data['end_date'] = $depo_date->first_row();
					$data['start_date'] = $depo_date->last_row();
					$data['deposit'] = $depo_date;
				}
				else
				{
					$data['end_date'] = NULL;
					$data['start_date'] = NULL;
					$data['deposit'] = NULL;
				}
				
			$this->load->view('ajax/deposit_history', $data);
		}
		else 
		{
			redirect('main/log_in');
		}
	}
	
	public function registation()
	{
		$this->load->view('nw_registation');
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

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {
	
	
	public function __construct() {
		
		session_start();
		
		parent::__construct();
		$this->load->database();
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$GLOBALS['zone'] = +6;
		$GLOBALS['currency'] = '$';
	}
	
	public function offer()
	{
		if($this->check() != false) 
		{
			$data['live']="";
			$data['betSlip']="";
			$data['today']="";
			$data['mygame']="";
			
			$this->load->model('team_model');
			$this->load->model('commision');
			$this->load->model('match');

			$today = gmdate(("Y-m-d"), time()+$GLOBALS['zone']*60*60);
			$totime = gmdate(("h:i"), time()+$GLOBALS['zone']*60*60);
			
			$user_id = $_SESSION['id'];
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['balance'] = $this->db->query("SELECT * FROM balance WHERE user_id = '$user_id'");
			
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$query = $this->db->get_where('match', array('id' => $match_id));
			$matct = $query->row(0);
			
			$data['team1_nm'] = $this->team_model->tema_name($matct->team_1);
			$data['team1_fg'] = $this->team_model->tema_flag($matct->team_1);
			$data['team2_nm'] = $this->team_model->tema_name($matct->team_2);
			$data['team2_fg'] = $this->team_model->tema_flag($matct->team_2);
			
			$data['mat'] = $matct;
			$data['match_id'] = $matct->id;
			$data['team_1'] = $matct->team_1;
			$data['team_2'] = $matct->team_2;
			
			// all offer 
			$data['t1_gv'] = $this->db->query("SELECT *, SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_1' AND type = 'offer' AND status <> 'complete' GROUP BY amount, type ORDER BY amount DESC");
			$data['t1_ex'] = $this->db->query("SELECT *, SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_1' AND type = 'want' AND status <> 'complete' GROUP BY amount, type ORDER BY amount DESC");
			$data['t2_gv'] = $this->db->query("SELECT *, SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_2' AND type = 'offer' AND status <> 'complete' GROUP BY amount, type ORDER BY amount DESC");
			$data['t2_ex'] = $this->db->query("SELECT *, SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_2' AND type = 'want' AND status <> 'complete' GROUP BY amount, type ORDER BY amount DESC");
			
			// bet Slip
			$data['my_offer'] = $this->db->query("SELECT bid_offer_temp.*, team.name FROM `bid_offer_temp` JOIN `team` WHERE bid_offer_temp.status = 'runing' AND bid_offer_temp.offer_user_id = '$user_id' AND bid_offer_temp.support_team = team.id AND bid_offer_temp.match_id = '$match_id'");
			
			$data['my_accept'] = $this->db->query("SELECT bid_accepted_temp.*, bid_offer_temp.amount, bid_offer_temp.support_team, bid_offer_temp.incl, bid_offer_temp.offer_share, bid_offer_temp.type, bid_offer_temp.accepted_share, team.name FROM bid_offer_temp, team, bid_accepted_temp WHERE bid_accepted_temp.accept_user_id = '$user_id' AND bid_offer_temp.match_id = '$match_id' AND bid_offer_temp.id = bid_accepted_temp.offer_id AND bid_offer_temp.support_team = team.id");
			
			$sporce_typ = $matct->sporce_typ;
			$my_total_offer = 0; 
			$my_total_of_amount = 0; 
			$my_total_accept = 0;
			$my_total_acc_amount = 0;
			$my_total_stak_amount = 0; 
			$my_total_done_amount = 0; 
		
			foreach($data['my_offer']->result() as $offer_row) 
			{
				$my_total_offer = $my_total_offer + $offer_row->offer_share; 
				$free_lot = $offer_row->offer_share - $offer_row->accepted_share;
				
				if($offer_row->type == 'offer') { 
				$my_total_of_amount = $my_total_of_amount + ($offer_row->offer_share*$offer_row->amount); 
				$my_total_done_amount = $my_total_done_amount + ($offer_row->amount*$offer_row->accepted_share);
				 }
				if($offer_row->type == 'want') { 
				$my_total_of_amount = $my_total_of_amount + $offer_row->offer_share; 
				$my_total_done_amount = $my_total_done_amount + $offer_row->accepted_share;
				}
			}
		
			foreach($data['my_accept']->result() as $accept_row) 
			{
				$my_total_accept = $my_total_accept + $accept_row->share_amount;
				if($accept_row->type == 'offer') { 
				$my_total_acc_amount = $my_total_acc_amount + $accept_row->share_amount; }
				if($accept_row->type == 'want') { 
				$my_total_acc_amount = $my_total_acc_amount + ($accept_row->share_amount*$accept_row->amount); }
			}
		
			$my_total_stak_amount = $my_total_of_amount + $my_total_acc_amount; 
			$my_total_done = $my_total_done_amount + $my_total_acc_amount; 
			
			$ta1_offer = $this->db->query("SELECT SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_1' AND type = 'offer' AND status <> 'complete'");
			$ta1_want = $this->db->query("SELECT SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_1' AND type = 'want' AND status <> 'complete'");
			$ta2_offer = $this->db->query("SELECT SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_2' AND type = 'offer' AND status <> 'complete'");
			$ta2_want = $this->db->query("SELECT SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$matct->team_2' AND type = 'want' AND status <> 'complete'");
			
			$data['of1_sm'] = $ta1_offer->row(0);	
			$data['wn1_sm'] = $ta1_want->row(0);	
			$data['of2_sm'] = $ta2_offer->row(0);	
			$data['wn2_sm'] = $ta2_want->row(0);	
			
			$data['my_total_offer']=$my_total_offer;
			$data['my_total_accept']=$my_total_accept;
			$data['my_total_stak_amount']=$my_total_stak_amount; 
			$data['my_total_done']=$my_total_done;
						
			
			$data['ratio'] = $this->commision->commision_ratio();
			$data['mat_img'] = $sporce_typ.".png";
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('runing_offer', $data);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
	public function my_offer()
	{
		if($this->check() != false) 
		{
			$this->load->model('commision');
			$user_id = $_SESSION['id'];
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$data['ratio'] = $this->commision->commision_ratio();
			
			$data['my_offer'] = $this->db->query("SELECT bid_offer_temp.*, team.name FROM `bid_offer_temp` JOIN `team` WHERE bid_offer_temp.status = 'runing' AND bid_offer_temp.offer_user_id = '$user_id' AND bid_offer_temp.support_team = team.id AND bid_offer_temp.match_id = '$match_id'");
			
			$this->load->view('ajax/offerList', $data);
		}
	}
	
	public function my_acpt()
	{
		if($this->check() != false) 
		{
			$this->load->model('commision');
			$user_id = $_SESSION['id'];
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$data['ratio'] = $this->commision->commision_ratio();
			
			$data['my_accept'] = $this->db->query("SELECT bid_accepted_temp.*, bid_offer_temp.amount, bid_offer_temp.support_team, bid_offer_temp.offer_share, bid_offer_temp.type, bid_offer_temp.accepted_share, bid_offer_temp.incl, team.name FROM bid_offer_temp, team, bid_accepted_temp WHERE bid_accepted_temp.accept_user_id = '$user_id' AND bid_offer_temp.match_id = '$match_id' AND bid_offer_temp.id = bid_accepted_temp.offer_id AND bid_offer_temp.support_team = team.id");
			
			$this->load->view('ajax/acceptList', $data);
		}
	}
	
	public function live_offer()
	{
		if($this->check() != false) 
		{	
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$team = $this->security->xss_clean($this->uri->segment(4));
			
			$ta_offer = $this->db->query("SELECT SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$team' AND type = 'offer' AND status <> 'complete'");
			$ta_want = $this->db->query("SELECT SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$team' AND type = 'want' AND status <> 'complete'");
			
			$t_offer = $this->db->query("SELECT *, SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$team' AND type = 'offer' AND status <> 'complete' GROUP BY amount, type ORDER BY amount DESC");
			$t_want = $this->db->query("SELECT *, SUM(offer_share) AS total, SUM(accepted_share) AS total_acpt FROM bid_offer_temp WHERE match_id = '$match_id' AND support_team = '$team' AND type = 'want' AND status <> 'complete' GROUP BY amount, type ORDER BY amount DESC");
			
			$of_sm = $ta_offer->row(0);	
			$frqe = $of_sm->total - $of_sm->total_acpt;
			$wn_sm = $ta_want->row(0);	
			$frqw = $wn_sm->total - $wn_sm->total_acpt;
			
			$data = "<div class='w3-row padd'><div class='w3-col s6'><div class='w3-row'><div class='w3-col s7 po' onclick='offer(`{$team}`,`GIVEN`)'><span class='level_color'><i class='fa fa-plus-circle fa-lg' aria-hidden='true'></i></span><span class='text1'> GIVEN </span></div><div class='w3-col s5 w3-center'><span class='level_color'>{$frqe}</span><span class='w3-text-gray'> | {$of_sm->total}</span></div></div></div><div class='w3-col s6'><div class='w3-row'><div class='w3-col s7 po' onclick='offer(`{$team}`,`EXPECTED`)'> <span class='level_color'><i class='fa fa-plus-circle fa-lg' aria-hidden='true'></i></span><span class='text3'> EXPECTED </span></div><div class='w3-col s5 w3-center'><span  class='level_color'>{$frqw}</span><span class='w3-text-gray'> | {$wn_sm->total} </span></div></div></div></div>";
			$data.= "<div class='w3-row padd'><div class='w3-col s6 m6 offwi mrg'>";
				
			foreach($t_offer->result() as $offer) {
				
				$fre = $offer->total-$offer->total_acpt;
				$data.= "<div class='w3-row paste po' onClick='openAccept(`offer`,`{$offer->support_team}`,`{$offer->amount}`)'><div class='w3-col m7 s7 padd'> <span class='level_color'>{$offer->amount}</span></div><div class='w3-col m5 s5 w3-center padd'><span class='level_color'>{$fre}</span><span class='w3-text-gray'> | {$offer->total}</span></div></div>";
				}
				
			$data.= "</div><div class='w3-col s6 offwi m6 mrg'>";
			foreach($t_want->result() as $want) {
				
				$fre = $want->total-$want->total_acpt;
				$data.= "<div class='w3-row pink po' onClick='openAccept(`want`,`{$want->support_team}`,`{$want->amount}`)'><div class='w3-col m7 s7 padd'> <span class='level_color'>{$want->amount}</span></div><div class='w3-col m5 s5 w3-center padd'><span class='level_color'>{$fre}</span><span class='w3-text-gray'> | {$want->total}</span></div></div>";	
				}
			
			$data.= "</div></div>";
			echo $data;
		}
	}
	
	public function t_offer()
	{
		if($this->check() != false) 
		{
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$team = $this->uri->segment(4);
			$myfile = $match_id."_".$team.".html";
			
			$this->load->view('game/'.$myfile);
		}
		else 
		{
			redirect('user/log_in');
		}
	}
	
		
	public function accept_form()
	{
		if($this->check() != false) 
		{
			$user_id = $_SESSION['id'];
	
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$offer_type = $this->security->xss_clean($this->uri->segment(4));
			$team = $this->security->xss_clean($this->uri->segment(5));
			$amountrt = $this->security->xss_clean($this->uri->segment(6));
			$incl = $this->security->xss_clean($this->uri->segment(7));
				
				if($offer_type == 'offer')
				{
					$amount = 1;
					$typ = 'GIVEN';
					$cls = 'tnameg'; 
					$cls1 = 'of_txt_gv';
				}
				else
				{
					$amount = $amountrt;
					$typ = 'EXPECTED';
					$cls = 'tnameg_ex'; 
					$cls1 = 'of_txt_ex';
				}
			
			if($match_id > 0 and $amount > 0) 
			{
				$this->load->model('balan');
				$this->load->model('team_model');
				
				$data['team_name'] = $this->team_model->tema_name($team);
				$data['balance'] = $this->balan->remaning_amount($user_id);
				$data['types'] = $typ;
				$data['cls'] = $cls;
				$data['cls1'] = $cls1;
				
				$deposit_amount = $this->balan->deposit_amount($user_id);
			
				if($data['balance'] >= $amount AND $deposit_amount >= $amount)
				{
					$amount = $amountrt;
					
					$data['offers'] = $this->db->query("SELECT bid_offer_temp.*, SUM(bid_offer_temp.offer_share) AS total_offer, SUM(bid_offer_temp.accepted_share) AS total_accept, match.base_bid_amount FROM bid_offer_temp JOIN `match` ON match.id = bid_offer_temp.match_id
					WHERE bid_offer_temp.amount = '$amount'
					AND bid_offer_temp.match_id = '$match_id'
					AND bid_offer_temp.type = '$offer_type'
					AND bid_offer_temp.support_team = '$team'
					AND bid_offer_temp.incl = '$incl'
					AND bid_offer_temp.offer_user_id <> '$user_id'
					AND bid_offer_temp.status <> 'complete'");
			
					$data['currency'] = $GLOBALS['currency'];
					$data['zone'] = $GLOBALS['zone'];
				
					$this->load->view('ajax/offer_accept', $data);
				}	
				else
				{
					echo '<div style="color:#F00; text-align:center; margin-top:20px; font-size:20px;"> Sorry you don\'t have enough balance!</div>';
				}
			}
			else
			{
				echo "wrong access!";
			}
		
		}
		else
		{
			redirect('main/log_in');
		}
	}

	public function offer_form()
	{
		if($this->check() != false) 
		{
			$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
			$user_id = $_SESSION['id'];
			
			$match_id = $this->security->xss_clean($this->uri->segment(3));
			$team_id = $this->security->xss_clean($this->uri->segment(4));
			$typ = $this->security->xss_clean($this->uri->segment(5));
			
			$users = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$user = $users->row();
			
			$this->load->model('balan');
			$this->load->model('team_model');
			$this->load->model('match');
			
			if($typ == "EXPECTED") { $cls = 'tnameg_ex'; $cls1 = 'of_txt_ex'; } 
			else { $cls = 'tnameg'; $cls1 = 'of_txt_gv'; }
			
			$base_amaount =  $this->match->match_value($match_id,'base_bid_amount');
			$user_balance = $this->balan->remaning_amount($user_id);
			$team_name = $this->team_model->tema_name($team_id);
			
			if($user_balance >= $base_amaount)
			{
				$data['user_balance'] = $user_balance;
				$data['match'] = $this->match->get_all($match_id);
				$data['team_name'] = $team_name;
				$data['type'] = $typ;
				$data['cls'] = $cls;
				$data['cls1'] = $cls1;
				$data['team_id'] = $team_id;
				$data['currency'] = $GLOBALS['currency'];
				$data['zone'] = $GLOBALS['zone'];
				
				if($user->group != 'suspend') 
				{ 
					$this->load->view('ajax/new_offer', $data);
				}
				else
				{
					echo "Your account was suspended.";
				}
			}
			else
			{
				echo "<h1 style='color:#FFF; padding-top:10px; margin:5px;'>Sorry you don't have enough balance!</h1>";
			}
		}
		else
		{
			redirect('main/log_in');
		}
}
	
	public function new_offer()
	{
		if($this->check() != false) 
		{
			$matchid = $this->security->xss_clean($this->input->post('matchid'));
			$type = $this->security->xss_clean($this->input->post('type'));
			$amount = $this->security->xss_clean($this->input->post('amount'));
			$share = $this->security->xss_clean($this->input->post('share'));
			$supteam = $this->security->xss_clean($this->input->post('supteam'));
			$incl = $this->security->xss_clean($this->input->post('incl'));
			
			$this->db->trans_start();
			
			if($matchid > 0 and $supteam > 0 and $amount > 0 and $share > 0)
			{
				$this->load->model('balan');
				$this->load->model('match');
				$this->load->model('offer');
				
				if($type == "GIVEN") { $type_rq = 'offer'; } else { $type_rq = 'want'; }
				
				$draw = 'no';
				$user_id = $_SESSION['id'];
				$match_id = $matchid;
				$bet_amount = $amount;
				$share = $share;
				$type = $type_rq;
				$support_team = $supteam;
				$incl = '';
				$base_amount = $this->match->match_value($match_id, 'base_bid_amount');
				$real_amount = 0;
				$offer_exist;
				
				if($type == 'offer') { $real_amount = $bet_amount; $offer_exist = 'want'; } 
				if($type == 'want') { $real_amount = $base_amount; $offer_exist = 'offer'; }
				
				$total_amount = $real_amount*$share;
				
				if($total_amount <= $this->balan->remaning_amount($user_id) and $total_amount <= $this->balan->deposit_amount($user_id))
				{
					$query = $this->db->query("SELECT *, (offer_share - accepted_share) AS free_share, SUM(offer_share) AS offer, SUM(accepted_share) AS accepted FROM bid_offer_temp WHERE match_id = '$match_id' AND type = '$offer_exist' AND amount = '$bet_amount' AND support_team = '$support_team' AND incl = '$incl' AND offer_user_id <> '$user_id' AND status <> 'complite' GROUP BY amount LIMIT 1000");
					$result = $query->row(0);	
					
					if($query->num_rows() > 0 AND $result->free_share > 0)
					{
						$data['offer'] = $query;
						$data['currency'] = $GLOBALS['currency'];
						$data['zone'] = $GLOBALS['zone'];
						$this->load->view('ajax/offer_exist', $data);
					}
					else
					{
						if($this->match->match_validity($match_id))
						{
							$this->privious_offer($user_id, $match_id, $type);
							$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
							
							if($this->balan->get_amount($user_id, $total_amount))
							{
								$value = array
								(
								'offer_user_id' => $user_id,
								'match_id' => $match_id,
								'type' => $type,
								'support_team' => $support_team,
								'amount' => $bet_amount,
								'offer_share' => $share,
								'accepted_share' => 0,
								'status' => 'runing',
								'date' => $today,
								'incl' => $incl,	
								);
								
								$this->db->insert('bid_offer_temp', $value);
								
								$differ = $this->auto_banance_check($user_id) - $this->balan->betting_amount($user_id);
								if($differ > 1)
								{
									// close offer
									$this->db->delete('bid_offer_temp', array('id' => $this->db->insert_id())); 
									echo "tryagain";
								}
								else
								{
									echo "successfull";
								}
							}
						}
						else
						{							
							echo "matchover";
						}
					}
				}
				else
				{
					echo "balancenees";
				}
			}
			else
			{				
				echo "invalid";
			}
			
			$this->db->trans_complete();
		}
		else
		{
			redirect('main/log_in');
		}
	}
	
	
	public function offer_accept()
	{
		if($this->check() != false) 
		{
			$match_id = $this->security->xss_clean($this->input->post('match_id'));
			$share_value = $this->security->xss_clean($this->input->post('amount'));
			$offer_type = $this->security->xss_clean($this->input->post('type'));
			$support_team = $this->security->xss_clean($this->input->post('support_team'));
			$incl = $this->security->xss_clean($this->input->post('incl'));
			$ac_share =$this->security->xss_clean($this->input->post('share'));
			$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
				
			$this->db->trans_start();
			
			if($match_id > 0 AND $share_value > 0 AND $support_team > 0 AND isset($offer_type))
			{
				$this->load->model('balan');
				$this->load->model('offer');
				$this->load->model('match');
				$this->load->model('bid_accepted_model');
					
				$user_id = $_SESSION['id'];
	
				$base_amount = $this->match->match_value($match_id, 'base_bid_amount');
				
				if($offer_type == 'want') { $total_value = $ac_share * $share_value; $requested_amount = $share_value; }
				if($offer_type == 'offer') { $total_value = $base_amount * $ac_share; $requested_amount = $base_amount; }
				
				
				if($this->balan->remaning_amount($user_id) >= $total_value AND $ac_share > 0 AND $total_value <= $this->balan->deposit_amount($user_id))
				{ 
					$offers = $this->db->query("SELECT id, (offer_share - accepted_share) AS free_share FROM bid_offer_temp WHERE
					amount = '$share_value'
					AND match_id = '$match_id'
					AND type = '$offer_type'
					AND support_team = '$support_team'
					AND incl = '$incl'
					AND offer_user_id <> '$user_id'
					AND status <> 'complete' ORDER BY id ASC FOR UPDATE");
					
					$remain_accept = $ac_share;
					if($this->match->match_validity($match_id)) 
					{
						foreach($offers->result() as $offer)
						{
							if($offer->free_share > 0)
							{
								//$offer->free_share is enought
								if( $offer->free_share >= $remain_accept and $remain_accept > 0)
								{
									$total_value = $remain_accept*$requested_amount;
							
									if($this->balan->get_amount($user_id, $total_value))
									{
										$this->offer->get_share($offer->id, $remain_accept);
												
										$exis = $this->bid_accepted_model->check_offer_exist($offer->id, $user_id);
							
										if($exis < 1) 
										{
											$value = array
											(
											'offer_id' => $offer->id,
											'accept_user_id' => $user_id,
											'share_amount' => $remain_accept,
											'date' => $today,
											);
							
											$this->db->insert('bid_accepted_temp', $value);
											$remain_accept = 0;
										}
										else
										{
											$acc_share = $remain_accept + $this->bid_accepted_model->runing_share($offer->id, $user_id);
											$value = array
											(
											'share_amount' => $acc_share,
											'date' => $today,
											);
							
											$this->db->update('bid_accepted_temp', $value, array('offer_id' => $offer->id, 'accept_user_id' => $user_id));
											$remain_accept = 0;
										}
									}
								}
								//$offer->free_share not enought
								if( $offer->free_share < $remain_accept and $remain_accept > 0 and $offer->free_share > 0)
								{
									$total_value = $offer->free_share*$requested_amount;
							
									if($this->balan->get_amount($user_id, $total_value))
									{
							
										$this->offer->get_share($offer->id, $offer->free_share);
				
										$exis = $this->bid_accepted_model->check_offer_exist($offer->id, $user_id);
								
										if($exis < 1) 
										{
											$value = array
											(
											'offer_id' => $offer->id,
											'accept_user_id' => $user_id,
											'share_amount' => $offer->free_share,
											'date' => $today,
											);
							
											$this->db->insert('bid_accepted_temp', $value);
											$remain_accept = $remain_accept - $offer->free_share;
										}
										else
										{
											$exist_share = $offer->free_share + $this->bid_accepted_model->runing_share($offer->id, $user_id);
		
											$value = array
											(
											'share_amount' => $exist_share,
											'date' => $today,
											);
							
											$this->db->update('bid_accepted_temp', $value, array('offer_id' => $offer->id, 'accept_user_id' => $user_id));
											$remain_accept = $remain_accept - $offer->free_share;
										}	
									}
								}
							}
						}
						$this->db->trans_complete();
						
						if($remain_accept == 0) 
						{	
							echo "<div class='offersuccess'>Offer accept successfully!</div>";
						}
						else if($remain_accept < $ac_share and $remain_accept > 0)
						{
							echo "<div class='offersuccess'>Not all are accepted!</div>";
						}
						else if($remain_accept == $ac_share)
						{
							echo "<div class='offersuccess'>Try Again!</div>";
						}
						else
						{
							echo "<div class='offersuccess'>Try Again!</div>";
						}
					}
					else
					{
						$this->db->trans_complete();
						echo "<div class='offersuccess'>Sorry! The match is over.</div>";
					}
				}
				else
				{
					$this->db->trans_complete();
					echo "<div class='offersuccess'>Sorry you dont have enough balance!</div>";
				}
			}
			else
			{
				$this->db->trans_complete();
				echo "<div class='offersuccess'>Sorry something wrong! Try again.</div>";
			}
		}
		else
		{
			redirect('main/log_in');
		}
	}
	
	public function auto_banance_check($user_id)
	{
		$offers = $this->db->query("SELECT amount, offer_share, type FROM bid_offer_temp WHERE offer_user_id = '$user_id' AND status = 'runing'");
		$to_amt = 0;
		
		foreach($offers->result() as $offer) 
		{
			if($offer->type == 'offer')
			{
				$to_amt = $to_amt + ($offer->amount * $offer->offer_share);
			}
			if($offer->type == 'want')
			{
				$to_amt = $to_amt + $offer->offer_share;
			}
		}
		
		$accepts = $this->db->query("SELECT bid_offer_temp.amount, bid_accepted_temp.share_amount, bid_offer_temp.type FROM bid_offer_temp, bid_accepted_temp WHERE bid_offer_temp.status = 'runing' AND bid_accepted_temp.accept_user_id = '$user_id' AND bid_offer_temp.id = bid_accepted_temp.offer_id");
		
		foreach($accepts->result() as $accept) 
		{
			if($accept->type == 'offer')
			{
				$to_amt = $to_amt + $accept->share_amount;
			}
			if($accept->type == 'want')
			{
				$to_amt = $to_amt + ($accept->amount * $accept->share_amount);
			}
		}
		
		return $to_amt;
	}
	
	
	public function check() {
		
		if(isset($_SESSION['id']) AND $_SESSION['super_id'] != NULL) {
			
			return true;
		}
		else {
			return false;
		}
	}
	
	
	public function betslip()
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
			
			$this->load->model('commision');
			$this->load->model('match');
			$off_mat_name = array();
			$acc_mat_name = array();
			$off_mat_img = array();
			$acc_mat_img = array();
			$offer = array();
			$accept = array();
			
			$runing_offer = $this->db->query("SELECT `match_id` FROM `bid_offer_temp` WHERE status = 'runing' AND `offer_user_id` = '$user_id' GROUP BY match_id");
			
			foreach($runing_offer->result() as $match)
			{
				$offer[] = $this->db->query("SELECT bid_offer_temp.*, team.name, bid_offer_temp.match_id FROM `bid_offer_temp` JOIN `team` WHERE bid_offer_temp.status = 'runing' AND bid_offer_temp.offer_user_id = '$user_id' AND bid_offer_temp.support_team = team.id AND bid_offer_temp.match_id = '$match->match_id'");
				array_push($off_mat_name, $this->match->match_name($match->match_id));
				array_push($off_mat_img, $this->match->match_value($match->match_id,'sporce_typ'));
			}
			$runing_offer->free_result();
			$match = NULL;
			
			$runing_accept = $this->db->query("SELECT bid_offer_temp.match_id FROM bid_accepted_temp, bid_offer_temp WHERE bid_offer_temp.status = 'runing' AND bid_offer_temp.id = bid_accepted_temp.offer_id AND bid_accepted_temp.accept_user_id = '$user_id' GROUP BY bid_offer_temp.match_id");
			
			foreach($runing_accept->result() as $match)
			{
				$accept[] = $this->db->query("SELECT bid_accepted_temp.*, bid_offer_temp.amount, bid_offer_temp.offer_share, bid_offer_temp.type, bid_offer_temp.accepted_share, bid_offer_temp.match_id, bid_offer_temp.incl, bid_offer_temp.support_team, team.name FROM bid_offer_temp, team, bid_accepted_temp WHERE bid_accepted_temp.accept_user_id = '$user_id' AND bid_offer_temp.match_id = '$match->match_id' AND bid_offer_temp.id = bid_accepted_temp.offer_id AND bid_offer_temp.support_team = team.id");
				array_push($acc_mat_name, $this->match->match_name($match->match_id));
				array_push($acc_mat_img, $this->match->match_value($match->match_id,'sporce_typ'));
			}
			$runing_accept->free_result();
			$match = NULL;
			
			$data['off_mat_name'] = $off_mat_name;
			$data['acc_mat_name'] = $acc_mat_name;
			$data['off_mat_img'] = $off_mat_img;
			$data['acc_mat_img'] = $acc_mat_img;
			$data['offer'] = $offer;
			$data['accept'] = $accept;
			$data['ratio'] = $this->commision->commision_ratio();
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			$data['betSlip']= "aciveMenu";
			
			$this->load->view('bet_slip', $data);
		}
		else
		{
			redirect('main/log_in');
		}
		
	}
	
	
	public function offer_update_form()
	{
		if($this->check() != false) 
		{
			$this->load->model('balan');
			$user_id = $_SESSION['id'];
			$offer_id = $this->security->xss_clean($this->uri->segment(3));
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['user_balance'] = $this->balan->remaning_amount($user_id);
			
			$data['offer'] = $this->db->query("SELECT bid_offer_temp.*, team.name FROM bid_offer_temp, team WHERE bid_offer_temp.id = '$offer_id' AND bid_offer_temp.offer_user_id = '$user_id' AND bid_offer_temp.status = 'runing' AND bid_offer_temp.support_team = team.id");
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('ajax/update_offer', $data);
		}
		else
		{
			redirect('user/log_in');
		}
	}
	
	public function accept_update_form()
	{
		if($this->check() != false) 
		{
			$this->load->model('balan');
			$user_id = $_SESSION['id'];
			$accept_id = $this->uri->segment(3);
			
			$data['user'] = $this->db->query("SELECT * FROM user WHERE id = '$user_id' AND status = 'active'");	
			$data['user_balance'] = $this->balan->remaning_amount($user_id);
			$data['offers'] = $this->db->query("SELECT bid_accepted_temp.*, bid_offer_temp.type, bid_offer_temp.support_team, bid_offer_temp.amount, bid_offer_temp.offer_share, bid_offer_temp.accepted_share, bid_offer_temp.incl, bid_offer_temp.match_id FROM bid_accepted_temp JOIN bid_offer_temp WHERE bid_accepted_temp.id = '$accept_id' AND bid_accepted_temp.accept_user_id = '$user_id' AND bid_offer_temp.status = 'runing' AND bid_offer_temp.id = bid_accepted_temp.offer_id");
			
			$data['currency'] = $GLOBALS['currency'];
			$data['zone'] = $GLOBALS['zone'];
			
			$this->load->view('ajax/update_accept', $data);
		}
		else
		{
			redirect('main/log_in');
		}
	}
	
	public function close_offer()
	{
		if($this->check() != false) 
		{
			$this->load->model('offer');
			$this->load->model('match');
			$this->load->model('balan');
			$user_id = $_SESSION['id'];
			
			if($this->input->post('off_id') != NULL) 
			{
				$offer_id =  $this->security->xss_clean($this->input->post('off_id', true));
			}
			else
			{
				$offer_id =  $this->security->xss_clean($this->uri->segment(3));
			}
			
			$offer_user_id = $this->offer->get_offer_user_id($offer_id);
			$match_id = $this->offer->offer_value($offer_id, 'match_id');
			$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
			
			if($offer_user_id == $user_id)
			{
				if($this->match->match_validity($match_id))
				{
					$accepted_share = $this->offer->accepted_share_lok($offer_id);
					$offer_share = $this->offer->offer_value($offer_id, 'offer_share');
					$base_bid_amount = $this->match->match_value($match_id, 'base_bid_amount');
					$typeR = $this->offer->offer_value($offer_id, 'type');
					
					if($accepted_share == 0)
					{
						$this->db->trans_start();
						
						if($typeR == "offer")
						{
							$amount = $this->offer->total_amount($offer_id);
							if($this->db->delete('bid_offer_temp', array('id' => $offer_id)))
							{
								$this->balan->clear_amount_add($user_id, $amount); 
								$this->db->trans_complete();
								echo "successfull";
							}
						}
						if($typeR == "want")
						{
							$amount = $base_bid_amount * $offer_share;
							if($this->db->delete('bid_offer_temp', array('id' => $offer_id)))
							{
								$this->balan->clear_amount_add($user_id, $amount); 
								$this->db->trans_complete();
								echo "successfull";
							}
						}
					}
					else
					{
						if($accepted_share < $offer_share)
						{
							$this->db->trans_start();
							$amount = $this->offer->offer_value($offer_id, 'amount');
							$diduct_share = $offer_share - $accepted_share;
	
							if($typeR == 'offer') { 
								$total_amount = $diduct_share * $amount; 
							}
							if($typeR == 'want') { 
								$total_amount = $diduct_share * $base_bid_amount; 
							}
							
							if($this->balan->clear_amount_add($user_id, $total_amount))
							{
								$this->db->update('bid_offer_temp', array('offer_share' => $accepted_share), array('id' => $offer_id));
								$this->db->trans_complete();
								echo "successfull";
							}
							else
							{
								echo "balance not update";
							}
						}
					}
				}
				else
				{
					echo "settled";
				}
			}
			else
			{
				redirect('main/log_in');
			}
		}
		else
		{
			redirect('main/log_in');
		}
	}
	
	
	public function update_offer()
	{
		if($this->check() != false) 
		{
			$this->load->model('offer');
			$this->load->model('match');
			$this->load->model('balan');
				
			$user_id = $_SESSION['id'];
			
			$offer_id =  $this->security->xss_clean($this->input->post('offer_id'));
			$offer_user_id = $this->offer->get_offer_user_id($offer_id);
			$match_id = $this->offer->offer_value($offer_id, 'match_id');
			$offer_sharen = $this->security->xss_clean($this->input->post('share'));
			$prev_lot = $this->security->xss_clean($this->input->post('prev_lot'));
			
			$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
			
			if($offer_user_id  == $user_id)
			{
				if($this->match->match_validity($match_id))
				{
					if($offer_sharen > 0)
					{
						$this->db->trans_start();
						
						$offer_shareo = $this->offer->offer_value_lok($offer_id, 'offer_share');
						$shre_accepted = $this->offer->offer_value_lok($offer_id, 'accepted_share');
						$type = $this->offer->offer_value($offer_id, 'type');
						$match_base_amount = $this->match->match_value($match_id, 'base_bid_amount');
						$amount = $this->offer->offer_value($offer_id, 'amount');
						
						if($shre_accepted <= $offer_sharen) 
						{
							if($offer_shareo < $offer_sharen)
							{	
								$extra_share = $offer_sharen - $offer_shareo;
						
								if($type == 'offer') { $total_amount = $extra_share * $amount; }
								if($type == 'want') { $total_amount = $extra_share * $match_base_amount; }
						
								if($this->balan->remaning_amount_lok($user_id) >= $total_amount)
								{
									if($this->balan->get_amount($user_id, $total_amount))
									{
										$this->db->update('bid_offer_temp', array('offer_share' => $offer_sharen), array('id' => $offer_id));
										echo "<div style='color:#FFF; font-size:18px; margin:10px;'>Offer update successfully!</div>";
									}
								}
								else
								{
									echo "<div style='color:#FFF; font-size:18px; margin:10px;'>Sorry! You don't have enough balance.</div>";
								}
							}
							if($offer_shareo > $offer_sharen)
							{
								$diduct_share = $offer_shareo - $offer_sharen;
	
								if($type == 'offer') { $total_amount = $diduct_share * $amount; }
								if($type == 'want') { $total_amount = $diduct_share * $match_base_amount; }
							
								$this->balan->clear_amount_add($user_id, $total_amount);
								$this->db->update('bid_offer_temp', array('offer_share' => $offer_sharen), array('id' => $offer_id));
							
								echo "<div style='color:#FFF; font-size:18px; margin:10px;'>Offer update successfully!</div>";
							}
						}
						
						$this->db->trans_complete();
					}
					else
					{
						redirect('game/close_offer/'.$offer_id);
					}
				}
				else
				{
					echo "<div style='color:#FFF; font-size:18px; margin:10px; text-align:center;'>Offer was settle</div>";
				}
			}
			else
			{
				redirect('main/log_in');
			}
		}
		else
		{
			redirect('main/log_in');
		}
	}
	
	public function privious_offer($user_id, $match_id, $type)
	{
		$offer_exist = $this->db->query("SELECT * FROM bid_offer_temp WHERE offer_user_id = '$user_id' AND match_id = '$match_id' AND type = '$type' AND status <> 'complete' AND offer_share > accepted_share");
		
		if($offer_exist->num_rows() > 0)
		{
			$offer_runing = $offer_exist->row(0);
			$this->load->model('balan');
			$this->load->model('match');
			$this->load->model('offer');
			// free share 
			$extra = $offer_runing->offer_share - $offer_runing->accepted_share;
			$base_amount = $this->match->match_value($match_id, 'base_bid_amount');
			
			if($extra > 0 and $offer_runing->accepted_share > 0)
			{
				
				if($offer_runing->type == 'offer')
				{
					$free_amount = $extra * $offer_runing->amount;
					$this->offer->update_share($offer_runing->id, $extra);
					$this->balan->clear_amount_add($offer_runing->offer_user_id, $free_amount);
				}
				else
				{
					$free_amount = $extra * $base_amount;
					$this->offer->update_share($offer_runing->id, $extra);
					$this->balan->clear_amount_add($offer_runing->offer_user_id, $free_amount);
				}
			}
			if($offer_runing->accepted_share == 0)
			{
				if($offer_runing->type == 'offer')
				{
					$amount = $offer_runing->offer_share * $offer_runing->amount;
					if($this->balan->clear_amount_add($user_id, $amount))
					{
						$this->db->delete('bid_offer_temp', array('id' => $offer_runing->id)); 
					}
				}
				
				if($offer_runing->type == 'want')
				{
					$amount = $base_amount * $offer_runing->offer_share;
					if($this->balan->clear_amount_add($user_id, $amount))
					{
						$this->db->delete('bid_offer_temp', array('id' => $offer_runing->id)); 
					}
				}
			}
		}
	}
	
	public function need_balance()
	{
		$this->load->view('ajax/need_balance');
	}
}
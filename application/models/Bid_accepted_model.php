<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bid_accepted_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function check_offer_exist($off_id, $user_id)
	{
		$query = $this->db->get_where('bid_accepted_temp', array('offer_id' => $off_id, 'accept_user_id' => $user_id));
		$query = $query->num_rows(0);
		return $query;
		$query->free_result();
	}
	
	function runing_share($off_id, $user_id)
	{
		$query = $this->db->get_where('bid_accepted_temp', array('offer_id' => $off_id, 'accept_user_id' => $user_id));
		$query = $query->row(0);
		return $query->share_amount;
		$query->free_result();
	}
	
	function runing_acc_id($off_id, $user_id)
	{
		$query = $this->db->get_where('bid_accepted_temp', array('offer_id' => $off_id, 'accept_user_id' => $user_id));
		$query = $query->row(0);
		return $query->id;
		$query->free_result();
	}
}
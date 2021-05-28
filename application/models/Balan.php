<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balan extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function remaning_amount($id)
	{
		$query = $this->db->get_where('balance', array('user_id' => $id));
		$query = $query->row(0);
		return $query->remaning_amount;
		$query->free_result();
	}
	
	function remaning_amount_lok($id)
	{
		$query = $this->db->query("SELECT * FROM balance WHERE user_id = '$id' FOR UPDATE");
		$query = $query->row(0);
		return $query->remaning_amount;
		//$query->free_result();
	}
	
	function deposit_amount($id)
	{
		$query = $this->db->get_where('balance', array('user_id' => $id));
		$query = $query->row(0);
		return $query->dabit_amount;
		$query->free_result();
	}
	
	function betting_amount($id)
	{
		$query = $this->db->get_where('balance', array('user_id' => $id));
		$query = $query->row(0);
		return $query->betting_amount;
		$query->free_result();
	}
	
	function add_amount($id, $amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		if($this->db->query("UPDATE balance SET dabit_amount := (dabit_amount + '$amount'), remaning_amount := (remaning_amount + '$amount'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
	function clear_amount_add($id, $amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		if($this->db->query("UPDATE balance SET betting_amount := (betting_amount - '$amount'), remaning_amount := (remaning_amount + '$amount'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
	function get_amount($id, $amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		if($this->db->query("UPDATE balance SET remaning_amount := (remaning_amount - '$amount'), betting_amount:= (betting_amount + '$amount'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
		
	function dabit_amount($id)
	{
		$query = $this->db->get_where('balance', array('user_id' => $id));
		$query = $query->row(0);
		return $query->dabit_amount;
		$query->free_result();
	}
	
	function update_balance($id, $value)
	{
		if ($this->db->update('balance', $value, array('user_id' => $id)))
		{
			return true;
		}
	}
	
	function loos_betting($id, $amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		if($this->db->query("UPDATE balance SET dabit_amount := (dabit_amount - '$amount'), betting_amount:= (betting_amount - '$amount'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
	function win_betting($id, $amount, $win_amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		$remaning = $amount + $win_amount;
		if($this->db->query("UPDATE balance SET dabit_amount := (dabit_amount + '$win_amount'), betting_amount:= (betting_amount - '$amount'), remaning_amount := (remaning_amount + '$remaning'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
	function draw_betting($id, $amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		if($this->db->query("UPDATE balance SET betting_amount:= (betting_amount - '$amount'), remaning_amount := (remaning_amount + '$amount'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
	function withdraw_balance($id, $amount)
	{
		$today = gmdate(("Y-m-d h:i:s"), time()+$GLOBALS['zone']*60*60);
		if($this->db->query("UPDATE balance SET dabit_amount:= (dabit_amount - '$amount'), remaning_amount := (remaning_amount - '$amount'), update_time = '$today' WHERE user_id = '$id'"))
		{
			return true;
		}
	}
	
	function balance_trns_count($id, $mounth, $year)
	{
		
		$query = $this->db->query("SELECT COUNT(id) AS total_trns FROM transaction WHERE user_id = '$id' AND category = 'TRANSFER' AND amount_statue = 'minus' AND MONTH(date_time) = '$mounth' AND YEAR(date_time) = '$year'");
		$query = $query->row(0);
		return $query->total_trns;
	}
}
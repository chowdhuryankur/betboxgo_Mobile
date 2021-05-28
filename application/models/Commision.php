<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Commision extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function  transaction_by_date($date)
	{
		
	}
	
	function add_commision($value)
	{
		if($this->db->insert('commision', $value))
		{
			return true;
		}
	}
	
	function commision_ratio()
	{
		$query = $this->db->query("SELECT * FROM commision_rate WHERE id = 1");
		$query = $query->row(0);
		return $query->rate; 
		$query->free_result();
	}
	
		function commision_referral()
	{
		$query = $this->db->query("SELECT * FROM commision_rate WHERE id = 2");
		$query = $query->row(0);
		return $query->rate; 
		$query->free_result();
	}
}
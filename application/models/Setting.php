<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Setting extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	
	function bl_tran_limit($status)
	{
		$query = $this->db->query("SELECT status, location FROM setting WHERE description = '$status' AND name = 'bl_transfer'");
		$query = $query->row(0);
		return $query;
	
		$query->free_result();
	}
	
	function bl_tran_fee()
	{
		$query = $this->db->query("SELECT status FROM setting WHERE id = 6 AND name = 'bl_transfer'");
		$query = $query->row(0);
		return $query->status;
	
		$query->free_result();
	}
	
	function bank_limit($status)
	{
		$query = $this->db->query("SELECT status FROM setting WHERE description = '$status' AND name = 'bank withdraw'");
		$query = $query->row(0);
		return $query->status;
	
		$query->free_result();
	}
	
	function mobile_limit($status)
	{
		$query = $this->db->query("SELECT status FROM setting WHERE description = '$status' AND name = 'mobile withdraw'");
		$query = $query->row(0);
		return $query->status;
	
		$query->free_result();
	}	
}
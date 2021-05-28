<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usr extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function user_name($id)
	{
		$query = $this->db->query("SELECT fs_name, ls_name FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->fs_name. ' '. $query->ls_name ;
		$query->free_result();
	}
	
	function dob($id)
	{
		$query = $this->db->query("SELECT dob FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->dob;
		$query->free_result();
	}
	
	function get_super_id($id)
	{
		$query = $this->db->query("SELECT super_id FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->super_id;
		$query->free_result();
	}
	
	function status($id)
	{
		$query = $this->db->query("SELECT status FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->status;
		$query->free_result();
	}
	
	function type($id)
	{
		$query = $this->db->query("SELECT type FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->type;
		$query->free_result();
	}
	
	function get_email($id)
	{
		$query = $this->db->query("SELECT email FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->email;
		$query->free_result();
	}
	
	function is_unique($fild, $value)
	{
		$query = $this->db->query("SELECT id FROM user WHERE `$fild` = '$value'");
		if($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function get_mobile_no($id)
	{
		$query = $this->db->query("SELECT mobile FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->mobile;
		$query->free_result();
	}
	
	function user_group($id)
	{
		$query = $this->db->query("SELECT `group` FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->group;
		$query->free_result();
	}
	
	function trns_status($id)
	{
		$query = $this->db->query("SELECT trnsfer FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->trnsfer;
		$query->free_result();
	}
	
	function verification_status($id)
	{
		$query = $this->db->query("SELECT verification FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->verification;
		$query->free_result();
	}
	
	function get_pin($id)
	{
		$query = $this->db->query("SELECT pin_code FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->pin_code;
		$query->free_result();
	}
	
	function log_find($id)
	{
		$query = $this->db->query("SELECT user_id FROM `log_in_log` WHERE user_id = '$id'");
		$find = $query->num_rows();
		return $find;
		$query->free_result();
	}
	
	function get_reference_no($id)
	{
		$query = $this->db->query("SELECT reference FROM user WHERE id = '$id'");
		$query = $query->row(0);
		return $query->reference;
		$query->free_result();
	}
	
	function get_id($id)
	{
		$query = $this->db->query("SELECT id FROM user WHERE super_id = '$id' AND type <> 'Easy'");
		if($query->num_rows() > 0)
		{
			$query = $query->row(0);
			return $query->id;
		}
		else
		{
			return FALSE;
		}
		$query->free_result();
	}
}
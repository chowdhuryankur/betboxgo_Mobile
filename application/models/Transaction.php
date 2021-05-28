<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Transaction extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function  transaction_by_date($date)
	{
		
	}
	
	function add_transaction($value)
	{
		if($this->db->insert('transaction', $value))
		{
			return true;
		}
	}
	
	function dabit_amount($id)
	{
		$query = $this->db->get_where('balance', array('user_id' => $id));
		$query = $query->row(0);
		return $query ->dabit_amount;
		$query->free_result();
	}
	
	function update_balance($id, $value)
	{
		if ($this->db->update('balance', $value, array('user_id' => $id)))
		{
			return true;
		}
	}
}
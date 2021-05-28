<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function offer_value($id, $name)
	{
		$query = $this->db->query("SELECT * FROM bid_offer_temp WHERE id = '$id'");
		$queryx = $query->row(0);
		return $queryx->$name;
		$queryx->free_result();
	}
	
	function offer_status($id)
	{
		$query = $this->db->query("SELECT * FROM bid_offer_temp WHERE id = '$id'");
		$queryx = $query->row(0);
		return $queryx->status;
		$queryx->free_result();
	}
	
	function offer_value_lok($id, $name)
	{
		$query = $this->db->query("SELECT * FROM bid_offer_temp WHERE id = '$id' FOR UPDATE");
		$queryx = $query->row(0);
		return $queryx->$name;
		//$queryx->free_result();
	}
	
	function get_offer_user_id($id)
	{
		$query = $this->db->get_where('bid_offer_temp', array('id' => $id));
		$query = $query->row(0);
		$accepted = $query->offer_user_id;
		return $accepted;
		$query->free_result();
	}
	
	function free_share($id)
	{
		$query = $this->db->get_where('bid_offer_temp', array('id' => $id));
		$query = $query->row(0);
		$free = $query->offer_share - $query->accepted_share;
		return $free;
		$query->free_result();
	}
	
	function free_share_lok($id)
	{
		$query = $this->db->query("SELECT * FROM bid_offer_temp WHERE id = '$id' FOR UPDATE");
		$query = $query->row(0);
		$free = $query->offer_share - $query->accepted_share;
		return $free;
		//$query->free_result();
	}
	
	function accepted_share($id)
	{
		$query = $this->db->get_where('bid_offer_temp', array('id' => $id));
		$query = $query->row(0);
		$accepted = $query->accepted_share;
		return $accepted;
		$query->free_result();
	}
	
	function accepted_share_lok($id)
	{
		$query = $this->db->query("SELECT * FROM bid_offer_temp WHERE id = '$id' FOR UPDATE");
		$query = $query->row(0);
		$accepted = $query->accepted_share;
		return $accepted;
		//$query->free_result();
	}
	
	function get_share($id, $new)
	{
		if($this->db->query("UPDATE bid_offer_temp SET accepted_share := (accepted_share + '$new') WHERE id = '$id'"))
		{
			return true;
		}
		$query->free_result();
	}
	
	function update_share($id, $extra)
	{
		if($this->db->query("UPDATE bid_offer_temp SET offer_share := (offer_share - '$extra') WHERE id = '$id'"))
		{
			return true;
		}
		$query->free_result();
	}
	
	function get_all_type($id, $type)
	{
		$query = $this->db->query("SELECT id FROM bid_offer_temp WHERE match_id = $id AND type = '$type'");
		return $query->num_rows();
		$query->free_result();
	}
	
	function total_amount($id)
	{
		$query = $this->db->get_where('bid_offer_temp', array('id' => $id));
		$query = $query->row(0);
		$total = $query->amount * $query->offer_share;
		return $total;
		$query->free_result();
	}
	
	function offer_complite($id)
	{
		$this->db->update('bid_offer_temp', array('status' => 'complite'), array('id' => $id));
	}
	
	function match_find($id)
	{
		$query = $this->db->get_where('bid_offer_temp', array('match_id' => $id));
		$result = $query->num_rows();
		
		return $result;
		$query->free_result();
	}
}
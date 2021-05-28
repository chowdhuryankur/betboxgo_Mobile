<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function tema_name($id)
	{
		$query = $this->db->get_where('team', array('id' => $id));
		$query = $query->row(0);
		return $query->name;
		$query->free_result();
	}
	
	function tema_flag($id)
	{
		$query = $this->db->get_where('team', array('id' => $id));
		$query = $query->row(0);
		if($query->flag != NULL) 
		{ 
			return $query->flag; 
		}
		else
		{
			return "flag.png";
		}
		$query->free_result();
	}
	
	function cat_find($id)
	{
		$query = $this->db->query("SELECT COUNT(id) AS total FROM team WHERE catagory = '$id'");
		$query = $query->row(0);

		return $query->total;
		$query->free_result();
	}

}
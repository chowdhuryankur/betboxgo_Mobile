<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Match extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function match_value($id, $name)
	{
		$query = $this->db->get_where('match', array('id' => $id));
		$query = $query->row(0);
		return $query->$name;
		
		$query->free_result();
	}
	
	function match_name($id)
	{
		$query = $this->db->query("SELECT team_1, team_2 FROM `match` WHERE id = '$id'");
		$team = $query->row(0);
		$query->free_result();
		$team1 = $this->db->get_where('team', array('id' => $team->team_1));
		$team_1 = $team1->row(0);
		$team2 = $this->db->get_where('team', array('id' => $team->team_2));
		$team_2 = $team2->row(0);
		$team1->free_result();
		$team2->free_result();
		
		return $team_1->name.' vs '.$team_2->name;
	}
	
	function match_validity($id)
	{
		$query = $this->db->get_where('match', array('id' => $id));
		$query = $query->row(0);
		if($query->status == 'complete')
		{
			return false;
			$query->free_result();
		}
		else
		{
			return true;
			$query->free_result();
		}
	}
	
	function get_all($id)
	{
		$query = $this->db->get_where('match', array('id' => $id));
		$query = $query->row(0);
		return $query;
		$query->free_result();
	}
	
}
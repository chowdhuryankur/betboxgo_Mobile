<?php
$GLOBALS['link'] = mysqli_connect('127.0.0.1:3307', 'root', '', "boxgo");
//mysqlii_select_db("betbox", $GLOBALS['link']);

function time_left($date1, $date2)
{
	$diff = abs(strtotime($date2) - strtotime($date1)); 

	$years   = floor($diff / (365*60*60*24));
	$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
	$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
	$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
	
	$dif = $hours.' Hour'. $minuts.' minuts left';
	
	return $dif;
}

function live_sign($match_time)
{
	$match_day = date('d', strtotime($match_time)); 
	$match_monty = date('m', strtotime($match_time));
	$match_time = date('G:i', strtotime($match_time));
	$match_timeh = date('G', strtotime($match_time));
	$match_timem = date('i', strtotime($match_time));
	$match_time = $match_timeh.$match_timem;
	
	$now_day = date('d');
	$now_month = date('m');
	$now_timeh = date('G');
	$now_timem = date('i');
	$now_time = $now_timeh.$now_timem;

	if($now_month >= $match_monty)
	{
		if($match_day <= $now_day) 
		{	
			$diff = $now_day - $match_day;
			if($now_time >= $match_time or $diff > 0)
			{
				echo '<button class="w3-button w3-tiny w3-yellow w3-round">LIVE</button>';
			}
			else
			{
				echo '<button class="w3-button w3-tiny w3-black w3-round">'.$match_timeh.':'.$now_timem.'</button>';
			}
		}
		else
		{
			echo '<button class="w3-button w3-tiny w3-black w3-round">'.$match_timeh.':'.$now_timem.'</button>';
		}
	}
}

function team_name($id) {
	$sql = "SELECT name FROM team WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return substr($name['name'],0,12);
	
	mysqli_free_result($name);
}

function team_short_code($id) {
	$sql = "SELECT short_code FROM team WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['short_code'];
	
	mysqli_free_result($name);
}

function match_name($id) {
	$sql = "SELECT team_1, team_2 FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return team_name($name['team_1']).' VS '.team_name($name['team_2']);
	
	mysqli_free_result($name);
}

function wining_team($id) {
	$sql = "SELECT wining_team FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	if($name['wining_team'] != 'Draw')
	{
		return team_name($name['wining_team']);
	}
	else
	{
		return $name['wining_team'];
	}
	
	mysqli_free_result($name);
}

function wining_team_id($id) {
	$sql = "SELECT wining_team FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['wining_team'];
	
	mysqli_free_result($name);
}

function match_starte_date($id) {
	$sql = "SELECT start_date_time FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['start_date_time'];
	
	mysqli_free_result($name);
}

function match_name_short($id) {
	$sql = "SELECT team_1, team_2 FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return team_short_code($name['team_1']).' v '.team_short_code($name['team_2']);
	
	mysqli_free_result($name);
}

function match_sign($id) {
	$sql = "SELECT sporce_typ FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	if($name['sporce_typ'] == "cricket")
	{
		$img = " <img src='".base_url()."img/Cricket_Ball.png' /> ";
	}
	if($name['sporce_typ'] == "football")
	{
		$img = " <img src='".base_url()."img/soccer_ball.png' /> ";
	}
	
	return $img;
	mysqli_free_result($name);
}

function team_flag($id) {
	$sql = "SELECT id, flag FROM team WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	if($name['flag'] != NULL)
	{
		$re = " <img src='".base_url()."images/flag/".$name['flag']."' height='16' class='imgf' /> ";
	}
	else
	{
		$re = NULL;
	}
	
	return $re;
	
	mysqli_free_result($sql);
}

function user_name($id) {
	$sql = "SELECT fs_name, ls_name FROM user WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['fs_name'].' '.$name['ls_name'];
	
	mysqli_free_result($name);
}

function user_dp_met($id) {
	$sql = "SELECT `group` FROM user WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['group'];
	
	mysqli_free_result($name);
}


function user_status($id) {
	$sql = "SELECT type FROM user WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['type'];
	
	mysqli_free_result($name);
}

function user_super_id($id) {
	$sql = "SELECT super_id FROM user WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['super_id'];
	
	mysqli_free_result($name);
}

function super_id_name($id) {
	$sql = "SELECT fs_name, ls_name FROM user WHERE super_id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['fs_name'].' '.$name['ls_name'];
	
	mysqli_free_result($name);
}

function based_amount($id) {
	$sql = "SELECT base_bid_amount FROM `match` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['base_bid_amount'];
	
	mysqli_free_result($name);
}

function offer_amount($id) {
	$sql = "SELECT amount FROM `bid_offer_temp` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['amount'];
	
	mysqli_free_result($name);
}

function offer_match($id) {
	$sql = "SELECT match_id FROM `bid_offer_temp` WHERE id = '$id'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$name = mysqli_fetch_array($result);
	
	return $name['match_id'];
	
	mysqli_free_result($name);
}

function total_offer($match_id, $type, $team) {
	
	$sql = "SELECT SUM(offer_share) AS total FROM bid_offer_temp WHERE match_id = '$match_id' AND type = '$type' AND support_team = '$team'";
	$result = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error());
	$row = mysqli_fetch_assoc($result);
	if($row['total'] > 0)
	{
		return $row['total'];
	}
	else
	{
		return 0;
	}
	
	mysqli_free_result($result);
}







?>
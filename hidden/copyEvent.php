<?
	/*
	copyEvent.php
	
	1.21.2012
	*/
	
	require_once('basic.php');
	require_once('extraMethods.php');
	
	$event_id = mysql_real_escape_string($_POST['event_id']);
	$user_id = mysql_real_escape_string($_SESSION['id']);
	
	$sql = "INSERT INTO readersScott (event_id, user_id) VALUES ('$event_id', '$user_id')";
	mysql_query($sql);
?>
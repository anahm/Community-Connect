<?
	header('Content-Type:application/json'); 
	require_once('basic.php');

	// TODO: security checks
	
	$event_id = mysql_real_escape_string($_POST['event_id']);
	
	$sql = "DELETE FROM events WHERE event_id = '$event_id'";
	mysql_query($sql);
	
	$sql = "DELETE FROM readersScott WHERE event_id = '$event_id'";
	mysql_query($sql);
?>
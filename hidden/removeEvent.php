<?
	header('Content-Type:application/json'); 
	require_once('basic.php');

	// TODO: security checks
	
	$event_id = mysql_real_escape_string($_POST['event_id']);
	$user_id = mysql_real_escape_string($_SESSION['id']);
	
	$sql = "DELETE FROM readersScott WHERE event_id = '$event_id' AND user_id = '$user_id'";
	mysql_query($sql);
?>
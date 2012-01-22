<?
	header('Content-Type:application/json'); 
	require_once('basic.php');
	
	$_SESSION["id"] = $_POST["user_id"];
?>
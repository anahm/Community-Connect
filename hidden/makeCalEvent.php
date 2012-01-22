<?
	/* makeCalEvent.php */
	
	require_once('basic.php');
	require_once('extraMethods.php');
	
	/* User must be logged in to make a calendar */
	if (!isset($_SESSION['id'])) {
		apologize("Must be logged in to add calendar");
		redirect("login.php");
	}
	$user_id = mysql_real_escape_string($_SESSION['id']);
	
	/* calendar name and id, write calendar */
	$wcal_name = mysql_real_escape_string($_POST['name']);
	
	/* Insert calendar into calendars database */
	$event_sql = "INSERT INTO calendarsScott (wcal_name) VALUES ('$wcal_name')";
	$event_result = mysql_query($event_sql);
	
	/* Get automatically generated calendar id */
	$wcal_id = mysql_insert_id();
	
	if (!$event_result)
		apologize("Cannot add calendar");
	
	/* Insert into writers database */
	$event_sql = "INSERT INTO writersScott (wcal_id, user_id) VALUES ('$wcal_id', '$user_id')";
	$event_result = mysql_query($event_sql);
	
	if (!$event_result)
		apologize("Cannot add calendar");
?>
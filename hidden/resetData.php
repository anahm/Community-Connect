<?
	header('Content-Type:application/json'); 
	require_once('basic.php');

	// Truncate current data
	
	$sql = "TRUNCATE TABLE calendarsScott";
	mysql_query($sql);
	
	$sql = "TRUNCATE TABLE events";
	mysql_query($sql);
	
	$sql = "TRUNCATE TABLE readersScott";
	mysql_query($sql);
	
	$sql = "TRUNCATE TABLE writersScott";
	mysql_query($sql);
	
	// Add some calendars and events
	
	// calendar 1
	$sql = "INSERT INTO calendarsScott (wcal_name) VALUES ('scottCal1')";
	mysql_query($sql);
	$id = mysql_insert_id();
	$sql = "INSERT INTO writersScott (wcal_id, user_id) VALUES ('$id', '4')";
	mysql_query($sql);
	
	$sql = "INSERT INTO events (title, location, sDateTime, eDateTime, wcal_id, description, tags) VALUES ('event1', 'location', '2012-01-01 08:45:00', '2012-01-2 14:55:00', '$id', 'description', 'tags')";
	mysql_query($sql);
	
	$sql = "INSERT INTO events (title, location, sDateTime, eDateTime, wcal_id, description, tags) VALUES ('event2', 'location', '2012-01-03 08:45:00', '2012-01-4 14:55:00', '$id', 'description', 'tags')";
	mysql_query($sql);
	
	// calendar 2
	$sql = "INSERT INTO calendarsScott (wcal_name) VALUES ('scottCal2')";
	mysql_query($sql);
	$id = mysql_insert_id();
	$sql = "INSERT INTO writersScott (wcal_id, user_id) VALUES ('$id', '4')";
	mysql_query($sql);
	
	$sql = "INSERT INTO events (title, location, sDateTime, eDateTime, wcal_id, description, tags) VALUES ('event3', 'location', '2012-01-09 08:45:00', '2012-01-09 14:55:00', '$id', 'description', 'tags')";
	mysql_query($sql);
	
	$sql = "INSERT INTO events (title, location, sDateTime, eDateTime, wcal_id, description, tags) VALUES ('event4', 'location', '2012-01-04 08:45:00', '2012-01-04 14:55:00', '$id', 'description', 'tags')";
	mysql_query($sql);
	
	$sql = "INSERT INTO events (title, location, sDateTime, eDateTime, wcal_id, description, tags) VALUES ('event5', 'location', '2012-01-06 08:45:00', '2012-01-06 12:55:00', '$id', 'description', 'tags')";
	mysql_query($sql);
	
	// calendar 3
	$sql = "INSERT INTO calendarsScott (wcal_name) VALUES ('aliCal3')";
	mysql_query($sql);
	$id = mysql_insert_id();
	$sql = "INSERT INTO writersScott (wcal_id, user_id) VALUES ('$id', '1')";
	mysql_query($sql);
	
	$sql = "INSERT INTO events (title, location, sDateTime, eDateTime, wcal_id, description, tags) VALUES ('event6', 'location', '2012-01-04 08:45:00', '2012-01-7 14:55:00', '$id', 'description', 'tags')";
	mysql_query($sql);
	
	
?>
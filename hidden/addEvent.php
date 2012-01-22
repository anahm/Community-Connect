<?
	/*
	addEvent.php

	Project X
	1.21.2012

	adding a new event through a php post request
	(data is being inputted on the index page)
	*/

	require_once('basic.php');
	require_once('extraMethods.php');

	// getting date from mm/dd/yyyy to yyyy-mm-dd
	$sDate = mysql_real_escape_string($_POST['sdate']);
	$sArray = explode('/', $sDate);
	$sDate = $sArray[2] . '-' . $sArray[0] . '-' . $sArray[1];

	$sTime = mysql_real_escape_string($_POST['stime']);

	// create start and end datetimes
	$start = $sDate . ' ' . $sTime;
	
	$eDate = mysql_real_escape_string($_POST['edate']);

	if (empty($_POST['edate']))
	{
		$eDate = $sDate;
	}
	else
	{
		$eDate = mysql_real_escape_string($_POST['edate']);
	}
	if (empty($_POST['etime']))
	{
		$eTime = $sTime + 3600;
	}
	else
	{
		$eTime = mysql_real_escape_string($_POST['etime']);
		$eArray = explode('/', $eDate);
		$eDate = $eArray[2] . '-' . $eArray[0] . '-' . $eArray[1];
	}

	$end = $eDate . ' ' . $eTime;
	
	$wcal_id = mysql_real_escape_string($_POST['wcal_id']);
	$eName = mysql_real_escape_string($_POST['name']);
	$eLoc = mysql_real_escape_string($_POST['location']);
	$eDesc = mysql_real_escape_string($_POST['blurb']);
	$tags = mysql_real_escape_string($_POST['tags']);

	// create a new entry using calendar 
	$event_sql = "INSERT INTO events 
	(title, location, sDateTime, eDateTime, wcal_id, description, tags)
	VALUES ('$eName',
	'$eLoc',
	'$start',
	'$end',
	'$wcal_id',
	'$eDesc', 
	'$tags')";
	$event_result = mysql_query($event_sql);
	if (!$event_result)
	apologize("Cannot add event.");
?>


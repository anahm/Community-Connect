<?
    /*
    	addEvent.php

	Project X
	1.13.12 (Friday the 13th!!)
	
	adding a new event through a php post request
	(data is being inputted on the index page)
    */

    require_once('basic.php');
    require_once('extraMethods.php');

    // validate submission
    /* if ((empty($_POST['title'])) || (empty($_POST['cal']))
	|| (empty($_POST['sdate']) && empty($_POST['stime'])))
    {
	apologize("Invalid submission. Please try again.");
    	exit;
    } */

    // getting date from mm/dd/yyyy to yyyy-mm-dd
    $sDate = mysql_real_escape_string($_POST['sdate']);
    $sArray = explode('/', $sDate);
    $sDate = $sArray[2] . '-' . $sArray[0] . '-' . $sArray[1];

    $sTime = mysql_real_escape_string($_POST['stime']);

    // create start and end datetimes
    $start = $sDate . ' ' . $sTime;

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

    $calId = '';
    if (!(empty($_POST['cal'])))
    {
	$cName = mysql_real_escape_string($_POST['cal']);
    	// find calendar ID based on calName in calendars table
    	$cal_sql = "SELECT * FROM calendars WHERE calName='$cName'";
    	$cal_result = mysql_query($cal_sql);
    	if (mysql_num_rows($cal_result) == 1)
    	{
	    $cal_row = mysql_fetch_array($cal_result);
	    $calID = $cal_row['calID'];
	}
    } 

    $eName = mysql_real_escape_string($_POST['name']);
    $eLoc = mysql_real_escape_string($_POST['location']);
    $eDesc = mysql_real_escape_string($_POST['blurb']);

    // create a new entry using calendar 
    $event_sql = "INSERT INTO events 
	(title, location, sDateTime, eDateTime, calID, description)
	VALUES ('$eName',
		'$eLoc',
		'$start',
		'$end',
		'$calID',
		'$eDesc')";
    $event_result = mysql_query($event_sql);
    if (!$event_result)
	apologize("Cannot add event.");
?>


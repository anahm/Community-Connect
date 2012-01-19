<?
    /*
	viewEvents.php

	1.18.12
	prints everything in the specified calendar
	in the post array
    */


    header('Content-Type:application/json');

    require_once('basic.php');

    $calName = mysql_real_escape_string($_POST['cal']);

    // execute sql query to get cal id
    $cal_sql = "SELECT calID FROM calendars WHERE calName='$calName'";
    $cal_result = mysql_query($cal_sql);
    if (!$cal_result)
	apologize("Calendar does not exist.");
    $cal_row = mysql_fetch_array($cal_result);
    $calID = $cal_row['calID'];


    $calID = 5;
    $event_array = array();

    // execute sql query to print all events in calendar
    $event_sql = "SELECT * FROM events WHERE calID='$calID'";
    $event_result = mysql_query($event_sql);
    while ($event_row = mysql_fetch_array($event_result))
    {
	$event_array[] = array(
		'id' => $event_row['eventID'],
		'title' => $event_row['title'],
		'content' => $event_row['description'],
		'start' => $event_row['sDateTime'],
		'end' => $event_row['eDateTime']
	    );
    }

    echo json_encode($event_array);

?>
    

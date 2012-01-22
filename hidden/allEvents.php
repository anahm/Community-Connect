<?
    /*
	viewEvents.php

	1.18.12
	prints everything
    */


    header('Content-Type:application/json');

    require_once('basic.php');

    $event_array = array();

    // execute sql query to print all events in calendar
    $event_sql = "SELECT * FROM events";
    $event_result = mysql_query($event_sql);
    while ($event_row = mysql_fetch_array($event_result))
    {
	$event_array[] = array(
		'id' => $event_row['event_id'],
		'title' => $event_row['title'],
		'content' => $event_row['description'],
		'start' => $event_row['sDateTime'],
		'end' => $event_row['eDateTime']
	    );
    }

    echo json_encode($event_array);

?>
    

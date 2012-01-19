<?
    /*
    	addEvent.php

	Project X
	1.13.12 (Friday the 13th!!)
	
	adding a new event through a php post request
	(data is being inputted on the index page)
	(based on framework.zend.com/manual/en/zend.gdata.calendar.html)
    */

    require_once('basic.php');
    require_once('extraLogin.php');

    // create a new entry using calendar 
    $service = new Zend_Gdata_Calendar($client);
    $event = newEvent();

    // populate event with desired info
    // each attribute is created as an instance of a matching class..
    $event->setTitle($_POST['name']);
    $event->setLocation($_POST['location']);
    $event->setSummary($_POST['blurb']);

    // need to get the google calendar id in calendars table
    $calResult = mysql_query("SELECT gcalUrl FROM calendars WHERE calID=$_POST['cal']"); 
    $calRow = mysql_fetch_array($calResult);
   
    // set date using rfc 3339 format
    $startDate = $_POST['sdate'];
    $startTime = $_POST['stime'];
    $endDate = $_POST['edate'];
    $endTime = $_POST['etime'];
    $tzOffset = "-05";
    
    // should probably get end date and end time...hm..
    $start = new EventDateTime();
    $start->setDateTime("{$startDate}T{$startTime}:00.000{$tzOffset}:00";
    $event->setStart($start);

    $end = new EventDateTime();
    $end->setDateTime("{$endDate}T{$endTime}:00.000{$tzOffset}:00";
    $event->setEnd($end);

    // upload event to calendar server
    // copy of the event as recorded is returned

    // $newEvent = $service->event->insert($event, 'http://www.google.com/calendar/feeds/hjamg3kumvuia89aqldv5gkves%40group.calendar.google.com/public/basic');
    $newEvent = $service->event->insert($event);
?>


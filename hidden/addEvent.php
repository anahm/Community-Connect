<?
    /*
    	addEvent.php

	Project X
	1.13.12 (Friday the 13th!!)
	
	adding a new event through a php post request
	(data is being inputted on the index page)
	(based on framework.zend.com/manual/en/zend.gdata.calendar.html)
    */

    require_once('extraLogin.php');

    // create a new entry using calendar 
    $service = new Zend_Gdata_Calendar($client);
    $event = $service->newEventEntry();

    // populate event with desired info
    // each attribute is created as an instance of a matching class..
    $event->title = $service->newTitle($_POST['name']);
    $event->where = array($service->newWhere($_POST['location']));
    $event->content = $service->newContent($_POST['blurb']);
    
    // set date using rfc 3339 format
    $startDate = $_POST['date'];
    $startTime = $_POST['time'];
    $tzOffset = "-05";
    
    // should probably get end date and end time...hm..

    $when = $service->newWhen();
    $when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
    $event->when = array($when);

    // upload event to calendar server
    // copy of the event as recorded is returned
    $newEvent = $service->insertEvent($event);

    header("Location: http://www.hcs.harvard.edu/projectx");

?>


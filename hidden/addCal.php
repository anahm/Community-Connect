<?
    /*
	addCal.php

	Project X
	1.15.12

	adding another calendar, given the calendar name doesn't already exist
	(based on stackoverflow.com/questions/1424373/google-calendar-api-selecting-creating-calendars)
    */

    require_once('extraLogin.php');

    // standard creation of http client
    $gdataCal = new Zend_Gdata_Calendar($client);

    try
    {
    	// get list of existing cal
    	$calFeed = $gdataCal->getCalendarListFeed();
    }
    catch (Zend_Gdata_App_Exception $e)
    {
	echo "Error: " . $e->getMessage();
    }

    $noCal = true;
    $newName = $_POST['calName'];

    // loop through calendars and check names
    foreach ($calFeed as $calendar)
    {
	if ($calendar->title->text == $newName)
	{
	    $noCal = false;
	}
    }

    // if name not found, create calendar
    if ($noCal)
    {
	$appCal = $gdataCal->newListEntry();
	$appCal->title = $gdataCal->newTitle($newName);

	// new url to post for new calendars
	$own_cal = "http://www.google.com/calendar/feeds/default/owncalendars/full";

	$gdataCal->insertEvent($appCal, $own_cal);
    }

    header("Location: http://www.hcs.harvard.edu/projectx");
?> 

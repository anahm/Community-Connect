<?
    /*
	addCal.php

	Project X
	1.15.12

	adding another calendar, given the calendar name doesn't already exist
	(based on stackoverflow.com/questions/1424373/google-calendar-api-selecting-creating-calendars)
    */

    header('Content-Type:application/json');

//    require_once('extraLogin.php');
    require_once('google-api-php-read-only/src/apiClient.php');
    require_once('google-api-php-read-only/src/contrib/apiCalendarService.php');

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

    $cal_array = array();

    // if name not found, create calendar
    if ($noCal)
    {
	$newCal = $gdataCal->newListEntry();
	$newCal->title = $gdataCal->newTitle($newName);

	// new url to post for new calendars
	$own_cal = "http://www.google.com/calendar/feeds/default/owncalendars/full";

	$bestCal = $gdataCal->insertEvent($newCal, $own_cal);

	$pattern = '/(?<=http:\/\/www.google.com\/calendar\/feeds\/default\/owncalendars\/full\/)(.*)(\%40group.calendar.google.com)/';
	$output = $bestCal->id->text;
	$tempId_array = array();
	preg_match_all($pattern, $output, $tempId_array);
	$calID = $tempId_array[1][0];

	// also need to add the special url
	$calUrl = $bestCal->content->src;

	// code to add the cal info to the calendars mysql table
	require_once('basic.php');
	$calName = mysql_real_escape_string($newName);
	$calResult = mysql_query("INSERT INTO calendars (calName, gcalID, gcalUrl)
		VALUES ('$calName', '$calID', '$calUrl')");
	
	if (!$calResult)
	    apologize("sorry folks, can't add this calendar to the sql table.");	 

	// code to add to writers table
	$uID = $_SESSION["id"];

	// need to get the sql stored calendar id
	$tempResult = mysql_query("SELECT calID FROM calendars WHERE calName='$calName'");
	if (mysql_num_rows($tempResult) == 1)
	{
	    $row = mysql_fetch_array($tempResult);
	    $sqlCalID = $row['calID'];  
	    $writeResult = mysql_query("INSERT INTO writers (userID, calID)
		VALUES ('$uID', '$sqlCalID')");	

	    if ($writeResult)
	    	apologize("sorry folks, can't add this calendar to writers sql table.");
	}
    }
?> 

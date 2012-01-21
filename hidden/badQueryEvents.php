<?
    /*
     * hcs.harvard.edu/hidden/queryEvents.php
     *
     * Project X - 1.13.12 (friday the thirteenth!)
     *
     * prints specifically queried information
     */

    header('Content-Type:application/json');

    require_once 'extraLogin.php';

    $service = new Zend_Gdata_Calendar($client);
    $query = $service->newEventQuery();
   
    $query->setUser('default');
    $query->setVisibility('private');
    $query->setOrderby('starttime');

    $query->setQuery($_GET['squery']);

    // retrieve the event list from calendar server
    try
    {
	$eventFeed = $service->getCalendarEventFeed($query);
    }
    catch (Zend_Gdata_App_Exception $e)
    {
	echo "Error: " . $e->getMessage();
    }

    $event_array = array();

    foreach ($eventFeed as $event)
    {
	foreach ($event->when as $when)
	{
	    $eventStart = $when->startTime;
	    $eventEnd = $when->endTime;
	}

	// can probably add in event url to link it and event location..
	$event_array[] = array(
	    'id' => $event->id->text,
	    'title' => $event->title->text,
	    'content' => $event->content->text,
	    'start' => $eventStart,
	    'end' => $eventEnd,
	);
    }

    echo json_encode($event_array);
?>


<?
    header('Content-Type:application/json');

    require_once 'extraLogin.php';

    // retrieving events without query parameters
    $gdataCal = new Zend_Gdata_Calendar($client);
// NEED TO ITERATE THROUGH ALL POSSIBLE IDS!!!!
    $query = $gdataCal->newEventQuery();
    $query->setUser($id . '@group.calendar.google.com');
    $query->setVisibility('private');
    $query->setOrderby('starttime');

    $eventFeed = $gdataCal->getCalendarEventFeed();

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

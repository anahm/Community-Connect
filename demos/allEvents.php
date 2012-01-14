<?
    header('Content-Type:application/json');

    require_once 'Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata');
    Zend_Loader::loadClass('Zend_Gdata_AuthSub');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_Calendar');

    // ClientLogin username/password authentication
    $user = 'alison.nahm@gmail.com';
    $pass = 'wobble31';
    $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

    // retrieving events without query parameters
    $gdataCal = new Zend_Gdata_Calendar($client);
    $eventFeed = $gdataCal->getCalendarEventFeed();

    $event_array = array();

    foreach ($eventFeed as $event)
    {
	foreach ($event->when as $when)
	{
	    $eventStart = $when->startTime;
	    $eventEnd = $when->endTime;
	}

	$event_array[] = array(
//	    'id' => $event->id,
	    'id' => $event->id->text,
	    'title' => $event->title->text,
	    'content' => $event->content->text,
	    'start' => $eventStart,
	    'end' => $eventEnd
	);
    }

    echo json_encode($event_array);

?>


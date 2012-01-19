<?
    header('Content-Type:application/json');

    require_once ('auth.php');

    $events = $service->events->listEvents('primary');

    $event_array = array();

    while(true) 
    {
  	foreach ($events->getItems() as $event) 
	{
	    // can probably add in event url to link it and event location..
	    $event_array[] = array(
	    	'id' => $event->getId(),
	   	'title' => $event->getSummary(),
	  	'content' => $event->getDescription(),
	  	'location' => $event->getLocation(),
	 	'start' => $event->getDateTime(),
	 	'end' => $event->getDateTime()
	    );
	}
    }

    echo json_encode($event_array);

?>

<?  
  /*

    viewCal.php

    search for events containing a specific word
    specifically in title, description, location

  */

header('Content-Type:application/json'); 
require_once('basic.php'); 

// get user id
$user_id = mysql_real_escape_string($_SESSION['id']);

// get calendar id; -2 means personal, -1 means all
$cal_id = mysql_real_escape_string($_POST['cal_id']);

// array of events
$event_array = array();

// Select the event_id's
$sql_1 = "";

switch ($cal_id) {
	/* Personal calendars */
	case -2:
		$sql_1 = "SELECT event_id FROM readersScott WHERE user_id = '$user_id'";
		break;
	case -1:
		$sql_1 = "SELECT event_id FROM events";
		break;
	default:
		$sql_1 = "SELECT event_id FROM events WHERE wcal_id = '$cal_id'";
}
$result_1 = mysql_query($sql_1);

while ($row_1 = mysql_fetch_array($result_1))
{
	$event_id = $row_1["event_id"];
	
	// select event with that id
	$sql_2 = "SELECT * FROM events WHERE event_id = '$event_id'";
	$result_2 = mysql_query($sql_2);
	$row_2 = mysql_fetch_array($result_2);
	
	// push into array
	$event_array[] = array(
    'id' => $row_2['event_id'],
    'title' => $row_2['title'],
    'content' => $row_2['description'],
    'start' => $row_2['sDateTime'],
    'end' => $row_2['eDateTime']
  );
}

echo json_encode($event_array);

?>
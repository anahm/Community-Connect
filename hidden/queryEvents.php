<?  
  /*

    queryEvents.php

    search for events containing a specific word
    specifically in title, description, location

  */

header('Content-Type:application/json'); 

require_once('basic.php'); 

if (empty($_GET['query'])) 
  apologize("Invalid query.");

$qString = mysql_real_escape_string($_GET['query']);

// making sql request to events table to query
$query_sql = "SELECT * FROM events
  WHERE MATCH (title, location, description)
  AGAINST ('$qString' IN BOOLEAN MODE)";
$query_result = mysql_query($query_sql);

// creating array to store valid events
$event_array = array();

while ($query_row = mysql_fetch_array($query_result))
{
  $event_array[] = array(
    'id' => $query_row['eventID'],
    'title' => $query_row['title'],
    'content' => $query_row['description'],
    'start' => $query_row['sDateTime'],
    'end' => $query_row['eDateTime']
  );
}

// if there are actually things in the array
if (!empty($event_array))
{
  // add the new queried cal to calendars table
  $cal_sql = "INSERT INTO calendars (calName, query)
    VALUES ('$qString', 1)";
  $cal_result = mysql_query($cal_sql);
  // if insert fails, error is reported
  if (!$cal_result)
    echo ("Cannot add calendar!");

  // also add new queried cal to readers table
  else
  {
    // if logged in, save calendar to readers table 
    if (!empty($_SESSION['id']))
    {
      $uID = $_SESSION['id'];
      $calID = mysql_insert_id();

      $read_sql = "INSERT INTO readers (userID, calID)
        VALUES ('$uID', '$calID')";
      $read_result = mysql_query($read_sql);
      
      // if insert fails, error is reported
      if (!$read_result)
        echo ("Cannot add to readers table.");
    }   
  }

  echo json_encode($event_array);
}
else
{
  // iono what to put here
}

?>

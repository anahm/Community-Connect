<?

    /*
	addShare.php

	can add more people to update events
    */

    require_once('basic.php');

    $newUser = $_POST['username'];
    $newCal = $_POST['calName'];

    // getting userID
    $user_sql = "SELECT userID FROM users WHERE username='$newUser'";
    $user_result = mysql_query($user_sql);
    
    if (mysql_num_rows($user_result) == 1)
    {
	$user_row = mysql_fetch_array($user_result);
	$userID = $user_row['userID'];
    }

    // getting calID
    $cal_sql = "SELECT calID FROM calendars WHERE calName='$newCal'";
    $cal_result = mysql_query($cal_sql);

    if (mysql_num_rows($cal_result) == 1)
    {
	$cal_row = mysql_fetch_array($cal_result);
	$calID = $cal_row['calID'];
    }

    // add user to writers tables
    $write_sql = "INSERT INTO writers (userID, calID)
	VALUES ('$userID', '$calID')";
    $write_result = mysql_query($write_sql);
    if (!$write_result)
	apologize("Cannot add sharers.");

?>

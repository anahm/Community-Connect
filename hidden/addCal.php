<?
    /*
	addCal.php

	Project X
	1.15.12

	adding another calendar, given the calendar name doesn't already exist
	(based on stackoverflow.com/questions/1424373/google-calendar-api-selecting-creating-calendars)
    */

    header('Content-Type:application/json');

    require_once('basic.php');

    $newName = $_POST['calName'];

    // code to add the cal info to the calendars mysql table
    $calName = mysql_real_escape_string($newName);
    $calResult = mysql_query("INSERT INTO calendars (calName)
	VALUES ('$calName')");
	
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
    
?> 

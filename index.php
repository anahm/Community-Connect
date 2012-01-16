<!DOCTYPE html>

<html>

    <head>
	<link rel='stylesheet' type='text/css' href='fullcal/cal.css'/>
	<link rel='stylesheet' type='text/css' href='css/styles.css' />
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
	<script type='text/javascript' src='fullcal/testcal.js'></script>

	<script type='text/javascript' src='events.js'></script>
	<script type='text/javascript' src='post.js'></script>

	<title>
	    SODAASN (+ scott)
	</title>
    </head>

    <body>
	<div id='loading' style='display:none'>
	    loading...
	</div>

	<table id='header'>
	    <th>
		Welcome (insert group name)!
	    </th>
	</table>

	<div id="addEvent">
	    <form name="newEvent" onsubmit="addEvent(); return false;" action="">
		<input type="hidden" name="groupID" value="WILLHOLDGROUPIDNUMBER"> 
		<table> 
		    <th>
			<td colspan="2">ADD EVENT</td>
		    </th>
		    <tr> 
			<td>Name:</td> 
			<td><input name="name" type="text"></td> 
		    </tr>
		    <tr>
			<td>Date:</td>
			<!-- should probably make this into a jquery datepicker -->
			<td><input name="date" type="text"></td>
		    </tr>
		    <tr>
			<td>Location:</td>
			<td><input name="location" type="text"></td>
	 	    </tr>
		    <tr>
			<td>Time:</td>
			<!-- could also make this better with jquery -->
			<td><input name="time" type="text"></td> 
		    </tr>
		    <tr>
			<td>Blurb!</td>
			<td><input name="blurb" type="text"></td>
		    </tr>
		    <tr>
			<td>Which calendar to add to?</td>
			<td>
			    <select name="caldropdown">
			    <?
echo("<option>hello world</option>");

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


echo("<option>hello world</option>");
				// create new entry using calendar
				$service = new Zend_Gdata_Calendar($client);
				$calFeed = $gdataCal->getCalendarListFeed();
	
				foreach ($calFeed as $calendar)
				{
				    $title = $calendar->title->text;
				    print("<option>");
				    print($title);
				    print("</option>");
				}
    			    ?>
			    </select>
			</td>	
		    </tr>
		    <tr>
			<td>Any tags?</td>
			<td>Well too bad, because you can't tag right now.</td>
		    </tr>
		    <tr>
			<td colspan="2"><input type="submit" value="ADD ME"></td>
		    </tr>
		</table>
	    </form>
	</div>

	<div id='calendar'>
	</div>

	<div id='lowerleft'>
	    <form name="qform" onsubmit="searchEvents(); return false;"  action="">
		<table>
		    <tr>
			<td>I want a calendar that has:</td>
			<td><input name="squery" type="text" value=""></td>
		    </tr>
		    <tr>
			<td colspan="2">
			    <input type="submit" name="button" value="SEARCH">
			</td>
		    </tr>
		</table>
	    </form>
	</div>

	<div>
	    <form name="newCal" onsubmit="addCal(); return false;" action="">
		<input name="userID" type="hidden" value="useridneedstogohere">
		<table>
		    <tr>
			<th colspan="2">Make-Your-Own</th>
		    </tr>
		    <tr>
			<td>Calendar Name:</td>
			<td><input name="calName" type="text" value=""></td>
		    </tr>
		    <tr>
			<td colspan="2"><input type="submit" name="button" value="MAKE"></td>
		    </tr>
		</table>
	    </form>
	</div> 

    </body>

</html>

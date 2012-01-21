<?
    require_once('hidden/basic.php');
    $uID = $_SESSION['id'];
?>

<!DOCTYPE html>

<html>

    <head>
	<link rel='stylesheet' type='text/css' href='css/reset.css'/>
	<link rel='stylesheet' type='text/css' href='fullcal/cal.css'/>
	<link rel='stylesheet' type='text/css' href='css/styles2.css' />
	<link rel='stylesheet' type='text/css' href='jquery-ui-1.8.17.custom/css/ui-lightness/jquery-ui-1.8.17.custom.css' />
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
	<script type='text/javascript' src='jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js'></script>
	<script type='text/javascript' src='jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js'></script>
	<script type='text/javascript' src='fullcal/fullcalendar.min.js'></script>
	<script type='text/javascript' src='functions.js'></script>
	<script type='text/javascript' src='events.js'></script>
	<script type='text/javascript' src='post.js'></script>

	<title>
	    SODAASN (+ scott)
	</title>
    </head>

    <body>

	<div id="curtain" onclick="showAddEvent()" >
	</div>
        <div id="add-dialog" title="Add Event">
            <form>
                <fieldset>
                    <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
                        <label for="date">Date</label>
                        <input type="text" name="date" id="datepicker">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="text ui-widget-content ui-corner-all" />
                        <label for="time">Time</label>
                        <input type="text" name="time" id="time" class="text ui-widget-content ui-corner-all" />
                        <label for="blurb">Blurb</label>
                        <input type="text" name="blurb" id="blurb" class="text ui-widget-content ui-corner-all" />
                    <label for="calendar">Calendar</label>
       	   	</fieldset>
   	    </form>
        </div>
	<div id="addEvent" class="bubble">
    	    <form name="newEvent" onsubmit="addEvent(); return false;" action="">
		<table> 
	    	    <th>
			<td colspan="2">ADD EVENT</td>
			    </th>
				<tr> 
				<td>Name:</td> 
				<td><input name="name" type="text"></td> 
				</tr>
				<tr>
				<td>Start Date:</td>
				<!-- should probably make this into a jquery datepicker -->
				<td><input name="sdate" type="text"></td>
			    </tr>
			    <tr>
				<td>End Date:</td>
				<!-- should probably make this into a jquery datepicker -->
				<td><input name="edate" type="text"></td>
			    </tr>


			    <tr>
				<td>Location:</td>
				<td><input name="location" type="text"></td>
			    </tr>
			    <tr>
			        <td>Start Time:</td>
				<!-- could also make this better with jquery -->
				<td><input name="stime" type="text"></td> 
			    </tr>
			    <tr>
				<td>End Time:</td>
				<td><input name="etime" type="text"></td> 
			    </tr>
			    <tr>
				<td>Blurb!</td>
				<td><input name="blurb" type="text"></td>
			    </tr>
			    <tr>
				<td>Which calendar to add to?</td>
				<td>
					<select id="caldropdown">
					<option>All Calendars You Can Add To</option>
					<?
					    // need to get sql info of calendars
					    $writeResult = mysql_query("SELECT * FROM writers WHERE userID=$uID");			
					    while ($writeRow = mysql_fetch_array($writeResult))
					    {
						$cID = $writeRow["calID"];
						$calResult = mysql_query("SELECT calName FROM calendars WHERE calID=$cID");
						$calRow = mysql_fetch_array($calResult);
						print("<option>" . $calRow["calName"] . "</option>");
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
				<td colspan="2"><input type="submit" name="button" value="ADD ME"></td>
				</tr>
			</table>
			</form>
		</div>
		
                <div id='home'>
                        <b>Home</b>
                        <b>Sign Out</b>
                </div>

                <div id='header'>
                        Welcome Project X!
                </div>

		<div id="right">
			<div id='lowerleft' class="bubble">
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
			
			<div id='calendar' class="bubble">
			</div>
			
		</div>

    </div>
	
	</body>

</html>

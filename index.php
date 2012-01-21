<?
    require_once('hidden/basic.php');
    $uID = $_SESSION['id'];
?>

<!DOCTYPE html>

<html>

	<head>
		<link rel="stylesheet" href="css/reset.css" type="text/css">
		<link rel='stylesheet' type='text/css' href='fullcal/cal.css'/>
		<link rel="stylesheet" href="css/styles2.css" type="text/css">
		<link rel="stylesheet" href="css/timepicker.css" type="text/css">
		<link rel="stylesheet" href="jquery-ui-1.8.17.custom/css/ui-lightness/jquery-ui-1.8.17.custom.css"></script>
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
		<script type='text/javascript' src='jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js'></script>
		<script type='text/javascript' src='jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js'></script>
		<script type='text/javascript' src='fullcal/fullcalendar.min.js'></script>
		<script type='text/javascript' src='timepicker.js'></script>
		<script type='text/javascript' src='functions.js'></script>
		<script type='text/javascript' src='events.js'></script>
		<script type='text/javascript' src='post.js'></script>
		
		<style>
			#addEvent label, #addEvent input { display:block; }
		</style>
		
		

		<title>
			SODAASN (+ scott)
		</title>
	</head>

	<body>
		<div id="addEvent" title="Add Event">
			<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all addEvent_input" />
				<label for="startDate">Start Date</label>
				<input type="text" name="startDate" id="startDate" class="text ui-widget-content ui-corner-all datepicker addEvent_input" />
				<label for="endDate">End Date</label>
				<input type="text" name="endDate" id="endDate" class="text ui-widget-content ui-corner-all datepicker addEvent_input" />
				<label for="startTime">Start Time</label>
				<input type="text" name="startTime" id="startTime" class="text ui-widget-content ui-corner-all timepicker addEvent_input" />
				<label for="endTime">End Time</label>
				<input type="text" name="endTime" id="endTime" class="text ui-widget-content ui-corner-all timepicker addEvent_input" />
				<label for="location">Location</label>
				<input type="text" name="location" id="location" class="text ui-widget-content ui-corner-all addEvent_input" />
				<label for="blurb">Blurb</label>
				<input type="text" name="blurb" id="blurb" class="text ui-widget-content ui-corner-all addEvent_input" />
				<label for="whichCal">Calendar</label>
				<select id="whichCal">
					<option>All Calendars</option>
					<?
						// need to get sql info of calendars
						$writeResult = mysql_query("SELECT * FROM writers WHERE userID = $uID");			
						while ($writeResult && ($writeRow = mysql_fetch_array($writeResult)))
						{
							$cID = $writeRow["calID"];
							$calResult = mysql_query("SELECT calName FROM calendars WHERE calID=$cID");
							$calRow = mysql_fetch_array($calResult);
							print("<option>" . $calRow["calName"] . "</option>");
						}
					?>
					</select>
				<label for="tags">Tags</label>
				<input type="text" name="tags" id="tags" class="text ui-widget-content ui-corner-all addEvent_input" />
			</fieldset>
			</form>
		</div>
		
		<div id="searchEvent" title="Search Event">
			
		</div>
		
		<div id='home'>
			<b>Sign Out</b>
		</div>
	
		<div id='header'>
			Welcome Project X!
		</div>
		
		<div style="display: block;">
			<div id='menu' class="bubble">
				<div id='yourCalendars' style="background-color: #969696; width: 100%;">
					Your Calendars:
				</div>
			</div>
			
			<div id="calContainer">
				<div id="searchEvent2" class="bubble">
					<form name="qform" onsubmit="searchEvents(); return false;" action="">
						<fieldset>
              <label for="query">I want a calendar that has:</label>
							<input type="text" name="query" id="query" class="text ui-widget-content ui-corner-all searchEvent_input" />
							<input type="submit" name="button" id="submitSearch" value="Search">
						</fieldset>
					</form>
				</div>
				<div id="buttons" class="bubble">
					<button id="add_button">Add Event</button>
					<button id="search_button">Search</button>
					<button id="make_button">Make Calendar</button>
				</div>
				<div class="bubble">
					<div id='calendar'>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

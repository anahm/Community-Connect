<?
    require_once('hidden/basic.php');
    $user_id = mysql_real_escape_string($_SESSION['id']);
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
    <script>
        $(document).ready(function()
        {
            if ((<? echo $user_id; ?>) != undefined)
              currentFeed['view'] = 'READ';
        });
				
				function resetData()
				{
					$.post("hidden/resetData.php");
					location.reload(true);
				}
				
				function login_user(id)
				{
					$.post("hidden/login_user.php",
					{
						user_id: id
					});
					location.reload(true);
				}
    </script>

		<style>
			#addEvent label, #addEvent input, #makeCalEvent label, #makeCalEvent input { display:block; }
		</style>
		<style>
			#yourCals .ui-selecting { background: #FECA40; }
			#yourCals .ui-selected { background: #F39814; color: white; }
		</style>

		<title>
			SODAASN (+ scott)
		</title>
	</head>

	<body>
	<?
		/* Function to get the calendar id's */
		function getCalIds($param_user_id)
		{
			$sql = "SELECT wcal_id FROM writersScott WHERE user_id = '$param_user_id'";
			$result = mysql_query($sql);
			
			// array to be returned
			$return_array = array();
			
			while ($row = mysql_fetch_array($result))
				array_push($return_array, $row["wcal_id"]);
			
			return $return_array;
		}
		
		/* Function to get the calendar names */
		function getCalNames($param_user_id)
		{
			$wcal_id_array = getCalIds($param_user_id);
			
			// array to be returned
			$return_array = array();
			
			foreach ($wcal_id_array as $wcal_id)
			{
				// get corresponding wcal_name
				$sql = "SELECT wcal_name FROM calendarsScott WHERE wcal_id = '$wcal_id'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				
				array_push($return_array, $row["wcal_name"]);
			}
			
			return $return_array;
		}
	?>
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
					<?
						/* Sets up select menu for all calendars user can edit
						value for each option is the calendar id */
						$wcal_id_array = getCalIds($user_id);
						
						foreach ($wcal_id_array as $wcal_id)
						{
							// get corresponding wcal_name
							$sql = "SELECT wcal_name FROM calendarsScott WHERE wcal_id = '$wcal_id'";
							$result = mysql_query($sql);
							$row = mysql_fetch_array($result);
							$wcal_name = $row["wcal_name"];
							echo "<option value='$wcal_id'>$wcal_name</option>";
						}
					?>
					</select>
				<label for="tags">Tags</label>
				<input type="text" name="tags" id="tags" class="text ui-widget-content ui-corner-all addEvent_input" />
			</fieldset>
			</form>
		</div>
		
		<div id="makeCalEvent" title="Make Calendar Event">
			<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name_makeCalEvent" class="text ui-widget-content ui-corner-all makeCalEvent_input" />
			</fieldset>
			</form>
		</div>
		
		<div id='home'>
			<?
				if (!isset($_SESSION["id"]))
				{
					echo '<a href="login.php">Sign In</a>';
				}
				else
				{
					$user_id = mysql_real_escape_string($_SESSION['id']);
					$sql = "SELECT email FROM users WHERE userID = '$user_id'";
					$result = mysql_query($sql);
					$row = mysql_fetch_array($result);
					echo $row["email"] . " ";
					echo '<a href="logout.php">Sign Out</a>';
				}
			?>
		</div>
	
		<div id='header'>
			Welcome!
		</div>
		
		<div style="display: block;">
			<? if (isset($_SESSION['id'])) { ?>
			<div id='menu' class="bubble">
				<div style="background-color: #969696; width: 100%;">
					Your Calendars:
				</div>
				<ol id="yourCals">
					<li type='read' value='-2' class='ui-widget-content'>Personal</li>
					<li type='search' value='-1' class='ui-widget-content'>All</li>
					<?
						/* Sets up select menu for all calendars user can edit
						value for each option is the calendar id */
						$wcal_id_array = getCalIds($user_id);
						
						foreach ($wcal_id_array as $wcal_id)
						{
							// get corresponding wcal_name
							$sql = "SELECT wcal_name FROM calendarsScott WHERE wcal_id = '$wcal_id'";
							$result = mysql_query($sql);
							$row = mysql_fetch_array($result);
							$wcal_name = $row["wcal_name"];
							echo "<li type='write' value='$wcal_id' class='ui-widget-content'>$wcal_name</li>";
						}
					?>
				</ol>
			</div>
			<?}?>
			
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
				<? if (isset($_SESSION['id'])) { ?>
				<div id="buttons" class="bubble">
					<button id="add_button">Add Event</button>
					<button id="make_button">Make Calendar</button>
				</div>
				<?}?>
				<div class="bubble">
					<div id='calendar'>
					</div>
				</div>
			</div>
			
			<div id="demoTools" class="bubble">
				<h1>Demo Tools</h1>
				<br />
				<button onclick="resetData()">Reset Data</button>
				<button onclick="login_user(1)">Ali</button>
				<button onclick="login_user(4)">szhuge</button>
			</div>
		</div>
    <div id="eventDetails">
    </div>
	</body>
</html>

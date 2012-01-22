/*
 * functions.js
 *
 * page functions that use jquery ui functions
 */


/* Listing all events that have been added to Project X.
 * (gets it through a json feed that dumps all of the google
 * calendar's events)
 */
var allFeed = 
{
	url: 'http://www.hcs.harvard.edu/projectx/hidden/allEvents.php',
	color: '#b2e0e0',
	textColor: 'black',
	type: 'POST',
	view: 'ALL',
	error: function()
	{
		alert('fail status. sorry, man.');
	}
};

var currentFeed = allFeed;

$(document).ready(function()
{
	$('#calendar').fullCalendar(
	{
		// php projectx data
		eventSources:
			[ allFeed ],
		eventClick: function(event)
		{ 
			var printString = "<h2> Event Information </h2> <br>";
			printString += "Title: " + event.title + "<br>";
			
			// changing date format - SCOTT FIX ITTTTTTTT (please)
			var startDate = new Date(event.start);
			var month = startDate.getMonth();
			var day = startDate.getDate();
			var year = startDate.getYear();
			var hour = startDate.getHours();
			var min = startDate.getMinutes();
			//printString = printString + "Start: " + month + " " + day + ", " + year
			//		+ " " + hour + ":" + min + "<br>";
			printString += "Start: " + event.start + "<br>";
			// changing end date format
			var endDate = new Date(event.end);
			var month = endDate.getMonth();
			var day = endDate.getDate();
			var year = endDate.getYear();
			var hour = endDate.getHours();
			var min = endDate.getMinutes();
			//printString = printString + "End: " + month + " " + day + ", " + year
			//		+ " " + hour + ":" + min + "<br>";
			printString += "End: " + event.end + "<br>";
			if (event.location)
				printString += "Location: " + event.location + "<br>";
			if (event.content)
				printString += "Description: " + event.content;
			
			$('#eventDetails').html(printString);
			var temp = currentFeed['view'];
			
			// define buttons
			var dialogButton = {
				"Cancel": function() {
					$(this).dialog("close");
				}
			};
			
			if (temp == 'write')
			{
				dialogButton = {
					"Delete": function() {
						// Todo: live updating
						/*var tempFeed = 
						{
							url: 'http://www.hcs.harvard.edu/projectx/hidden/deleteEvent.php/', 
							type: 'POST', 
							data: 
							{
								event_id: event.id
							}, 
							color: '#b2e0e0', 
							textColor: 'black'
						};
						
						$('#calendar').fullCalendar('removeEventSource', currentFeed);
						$('#calendar').fullCalendar('addEventSource', tempFeed);
						$('#calendar').fullCalendar('refetchEvents');
						currentFeed = tempFeed;*/
						$.post("hidden/deleteEvent.php",
						{
							event_id: event.id
						});
					}, 
					"Cancel": function() {
						$(this).dialog("close");
					}
				};
			}
			if (temp == 'read')
			{
				dialogButton = {
					"Remove": function() {
						$.post("hidden/removeEvent.php",
						{
							event_id: event.id
						});
					}, 
					"Cancel": function() {
						$(this).dialog("close");
					}
				};
			}
			if (temp == 'search')
			{
				dialogButton = {
					"Copy": function() {
						$.post("hidden/copyEvent.php",
						{
							event_id: event.id
						});
					}, 
					"Cancel": function() {
						$(this).dialog("close");
					}
				};
			}
			
			$(function() {
				$("#eventDetails").dialog({
					autoOpen: true, 
					width: 350, 
					modal: true, 
					buttons: dialogButton, 
					editable: true, 
					header: 
					{
						left: 'prev,next today', 
						center: 'title', 
						right: 'month,agendaWeek,agendaDay'
					}
				});
			});
		}
});

});

function searchEvents()
{
    var qString = document.qform.query.value;
    var tempFeed = 
	{
        url: 'http://www.hcs.harvard.edu/projectx/hidden/queryEvents.php/',
	    type: 'GET',
	    data:
		{
		    query: qString
		}, 
    	color: '#b2e0e0',
        textColor: 'black',
        view: 'SEARCH'
    };

    $('#calendar').fullCalendar('removeEventSource', currentFeed);
    $('#calendar').fullCalendar('addEventSource', tempFeed);
    $('#calendar').fullCalendar('refetchEvents');

    document.qform.query.value = "";
    currentFeed = tempFeed;
}

// sets the widgets for JQuery UI
$(function() {
	
	// activate date and time pickers in addEvent dialog form
	$(".datepicker").datepicker();
	$(".timepicker").timepicker();
	
	// addEvent dialog form
	$("#addEvent").dialog({
		autoOpen: false,
		height: 600, 
		width: 250, 
    modal: true, 
		buttons: {
			"Add Event": function() {
				var newName = document.getElementById("name").value;
				var startDate = document.getElementById("startDate").value;
				var endDate = document.getElementById("endDate").value;
				var startTime = document.getElementById("startTime").value;
				var endTime = document.getElementById("endTime").value;
				var newLoc = document.getElementById("location").value;
				var newBlurb = document.getElementById("blurb").value;
				var newCal = document.getElementById("whichCal").value;
				var newTags = document.getElementById("tags").value;
				
				$.post("hidden/addEvent.php",
				{
					name: newName,
					sdate: startDate,
					edate: endDate,
					location: newLoc,
					stime: startTime,
					etime: endTime,
					blurb: newBlurb,
					wcal_id: newCal, 
					tags: newTags
				});
				$(this).dialog("close");
			}, 
			"Cancel": function() { $(this).dialog("close"); }
		}, 
		close: function() { $(".addEvent_input").val("").removeClass("ui-state-error"); }
	});
	
	// make calendar event dialog form
	$("#makeCalEvent").dialog({
		autoOpen: false,
		height: 200, 
		width: 350, 
		modal: true, 
		buttons: {
			"Make Calendar": function() {
				var newName = document.getElementById("name_makeCalEvent").value;
				
				$.post("hidden/makeCalEvent.php", 
				{
					name: newName
				});
				
				$(this).dialog("close");
			}, 
			"Cancel": function() { $(this).dialog("close"); }
		}, 
		close: function() { $(".makeCalEvent_input").val("").removeClass("ui-state-error"); }
	});
	
	// activate buttons
	$("button").button();
	$("#submitSearch").button();
	
	// icons for buttons
	$("#add_button").button({
	icons: 	{
		primary: "ui-icon-plus"
		}
	});
	
	$("#make_button").button({
		icons: {
			primary: "ui-icon-document"
			}
	});
	
	// button functions
	$("#add_button").click(function() {
		$("#addEvent").dialog("open");
	});
	
	$("#make_button").click(function() {
		$("#makeCalEvent").dialog("open");
	});
	
	// sidebar activate
	$("#yourCals").selectable({
		stop: function() {
			$(".ui-selected", this).each(function() {
				var tempFeed = 
				{
					url: 'http://www.hcs.harvard.edu/projectx/hidden/viewCal.php/', 
					type: 'POST', 
					data: 
					{
						cal_id: this.value
					}, 
					color: '#b2e0e0', 
					textColor: 'black', 
					view: this.type
				};
				
				$('#calendar').fullCalendar('removeEventSource', currentFeed);
				$('#calendar').fullCalendar('addEventSource', tempFeed);
				$('#calendar').fullCalendar('refetchEvents');
				
				currentFeed = tempFeed;
			});
		}
	});
});

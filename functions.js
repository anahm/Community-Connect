/*
 * functions.js
 *
 * additional page functions that use jquery ui functions
 */

// sets the buttons for JQuery UI
$(function() {
	$("button").button();
	$(".datepicker").datepicker();
	$(".timepicker").timepicker();
	$("#submitSearch").button();
	
	$("#add_button").button({
	icons: 	{
		primary: "ui-icon-plus"
		}
	});

	$("#search_button").button({
		icons: {
			primary: "ui-icon-search"
		}

	});
				
	$("#make_button").button({
		icons: {
			primary: "ui-icon-document"
			}
	});

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
				var tags = document.getElementById("tags").value;
				
				$.post("hidden/addEvent.php",
				{
					name: newName,
					sdate: startDate,
					edate: endDate,
					location: newLoc,
					stime: startTime,
					etime: endTime,
					blurb: newBlurb,
					cal: newCal
				});
				
				$(".addEvent_input").val("");
				
				$(this).dialog("close");
			}, 
			"Cancel": function() { $(this).dialog("close"); }
		}, 
		close: function() { allFields.val("").removeClass("ui-state-error"); }
	});
	
	$("#searchEvent").dialog({
		autoOpen: false,
		height: 150, 
		width: 350, 
		modal: true, 
		buttons: {
			"Submit": function() {}, 
			"Cancel": function() { $(this).dialog("close"); }
		}, 
		close: function() { allFields.val("").removeClass("ui-state-error"); }
	});
	
	$("#add_button").click(function() {
		$("#addEvent").dialog("open");
	});
	
	$("#search_button").click(function() {
		$("#searchEvent").dialog("open");
	});
});
/*
 * functions.js
 *
 * additional page functions that use jquery ui functions
 */

// sets the buttons for JQuery UI
$(function() {
	$("button").button();
	$(".datepicker").datepicker();
	
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

	$("#add-dialog").dialog({
		autoOpen: false,
		height: 500, 
		width: 350, 
		modal: true, 
		buttons: {
			"Add Event": function() {
				alert("oh hey the first time");
			}, 
			"Cancel": function() { $(this).dialog("close"); }
		}, 
		close: function() { allFields.val("").removeClass("ui-state-error"); }
	});
	
	$("#add_button").click(function() {
		$("#add-dialog").dialog("open");
	});
});
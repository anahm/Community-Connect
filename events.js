/**
 * events.js
 *
 * Project X
 * 1.1.12
 *
 * Listing all events that have been added to Project X.
 * (gets it through a json feed that dumps all of the google
 * calendar's events)
 */

var allFeed = 
    {
    	url: 'http://www.hcs.harvard.edu/projectx/hidden/allEvents.php',
	color: '#b2e0e0',
	textColor: 'black',
	type: 'POST',
	error: function()
	{
	    alert('fail status. sorry, man.');
	},
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
        var printString = "<h2> Event Information </h2>";
        printString = printString + "<br>";
        printString = printString + "Title: " + event.title + "<br>";
        
        // changing date format - SCOTT FIX ITTTTTTTT (please)
        var startDate = new Date(event.start);
        var month = startDate.getMonth();
        var day = startDate.getDate();
        var year = startDate.getYear();
        var hour = startDate.getHours();
        var min = startDate.getMinutes();
        printString = printString + "Start: " + month + " " + day + ", " + year
            + " " + hour + ":" + min + "<br>";
        // changing end date format
        var endDate = new Date(event.end);
        var month = endDate.getMonth();
        var day = endDate.getDate();
        var year = endDate.getYear();
        var hour = endDate.getHours();
        var min = endDate.getMinutes();
        printString = printString + "End: " + month + " " + day + ", " + year
            + " " + hour + ":" + min + "<br>";
       
        if (event.location)
            printString = printString + "Location: " + event.location + "<br>";
        if (event.content)
            printString = printString + "Description: " + event.content;

        $('#eventDetails').html(printString);

	    $(function() {
          $("#eventDetails").dialog({
		    autoOpen: true,
		    width: 350, 
	        modal: true, 
		    buttons: {
                // depending on the type of calendar...all need to redirect to
                // a php file...
                //
                // NEED TO SAVE THE CALENDAR TYPE IN A SESSION VARIABLE
                // OR SOMETHING
                //
                // BLARGL 
                // 
                // if writer calendar 
                // "Update": function() {},
                // "Delete": function() {},
                // else if an event in saved viewer calendar
                // "Remove": function() {},
                // else if an event in recently searched calendar
                // "Add": function() {},
			    "Submit": function() {}, 
			    "Cancel": function() { $(this).dialog("close"); }
            }, 
		    close: function() { allFields.val("").removeClass("ui-state-error"); }
	      })
        });
	},
	editable: true,
	header:
	{
	    left: 'prev,next today',
	    center: 'title',
	    right: 'month,agendaWeek,agendaDay'
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
        textColor: 'black'
    };

    $('#calendar').fullCalendar('removeEventSource', currentFeed);
    $('#calendar').fullCalendar('addEventSource', tempFeed);
    $('#calendar').fullCalendar('refetchEvents');

    document.qform.query.value = "";
    currentFeed = tempFeed;
}

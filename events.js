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
	[
	    allFeed
	],
	eventClick: function(event)
	{
	    alert('oh hey there');
	    // opens events in a popup window
	    // window.open(event.url, 'gcalevent', 'width=700, height=600');
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

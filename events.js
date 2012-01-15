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
	color: '#4793E6',
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
	 /*   {
		url: 'http://www.hcs.harvard.edu/projectx/hidden/allEvents.php',
//		url: 'http://www.hcs.harvard.edu/projectx/hidden/queryEvents.php/?squery=cambridge',
		type: 'POST',
		error: function()
		{
		    alert('fail status. sorry, man.');
		},
	    } */
	]
/* extra stuff i don't really get.. 
	eventClick: function(event)
	{
	    // opens events in a popup window
	    window.open(event.url, 'gcalevent', 'width=700, height=600');
	},

	loading: function(bool)
	{
	    if (bool)
	    {
		$('#loading').show();
	    }
	    else
	    {
		$('#loading').hide();
	    }
	} */
    });
});

function searchEvents()
{
    var qString = document.qform.squery.value;
    var tempFeed = 
	{
            url: 'http://www.hcs.harvard.edu/projectx/hidden/queryEvents.php/',
	    type: 'GET',
	    data:
		{
		    squery: qString
		}, 
            color: '#4793E6',
            textColor: 'black'
        };

    $('#calendar').fullCalendar('removeEventSource', currentFeed);
    $('#calendar').fullCalendar('addEventSource', tempFeed);
    $('#calendar').fullCalendar('refetchEvents');

    document.qform.squery.value = "";
    currentFeed = tempFeed;
}

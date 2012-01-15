/**
 * qEvents.js
 *
 * Project X
 * 1.1.12
 *
 * Listing all the queried events that have been added to Project X.
 * (gets it through a json feed that dumps all of the google
 * calendar's events)
 */

function searchEvents()
{
    var qString = document.qform.squery.value;
    var tempFeed = {
	url: 'http://www.hcs.harvard.edu/projectx/hidden/allEvents.php',
    };
    $('#calendar').fullCalendar( 'removeEventSource', tempFeed);
    var tempFeed2 = {
	url: 'http://www.hcs.harvard.edu/projectx/hidden/queryEvents.php/?squery=cambridge',
	color: '#4793E6',
	textColor: 'black'
    };

    $('#calendar').fullCalendar( 'addEventSource', tempFeed2);


    $('#calendar').fullCalendar( 'refetchEvents' );
/*
    $('#calendar').fullCalendar(
    {
	// php projectx data
	eventSources:
	[
	    {
//		url: 'http://www.hcs.harvard.edu/projectx/hidden/queryEvents.php/?squery=cambridge',
		url: 'http://www.hcs.harvard.edu/projectx/hidden/allEvents.php',
		type: 'POST', 
		error: function()
		{
		    alert('failblog.');
		},
	    }
	]
   }); */
}

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

$(document).ready(function()
{
    $('#calendar').fullCalendar(
    {
	// php projectx data
	eventSources:
	[
	    {
		url: 'http://www.hcs.harvard.edu/projectx/hidden/allEvents.php',
		type: 'POST',
		error: function()
		{
		    alert('fail status. sorry, man.');
		},
	    }
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

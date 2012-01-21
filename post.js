/*
 *
 * post.js
 *
 * functions to make POST requests to specific urls
 */

function viewCal()
{
    // need to get the calID or name from the button
    var newCal = document.viewCal.button.value;
    $.post("http://www.hcs.harvard.edu/projectx/hidden/calEvents.php",
	{calID: newCal});
}

function addCal()
{
    var newName = document.newCal.calName.value;
    $.post("http://www.hcs.harvard.edu/projectx/hidden/addCal.php", {calName: newName});
    document.newCal.reset(); 
}

function addEvent()
{
    var newName = document.newEvent.name.value;
    var startDate = document.newEvent.sdate.value;
    var endDate = document.newEvent.edate.value;
    var newLoc = document.newEvent.location.value;
    var startTime = document.newEvent.stime.value;
    var endTime = document.newEvent.etime.value;
    var newBlurb = document.newEvent.blurb.value;
    var newCalIndex = document.getElementById("caldropdown").selectedIndex;
    var newCalArray = document.getElementById("caldropdown").options;
    var newCal = newCalArray[newCalIndex].text;

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
    document.newEvent.reset();

    $('#calendar').fullCalendar('refetchEvents');
}



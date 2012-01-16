/*
 *
 * post.js
 *
 * functions to make POST requests to specific urls
 */

function addCal()
{
    var newName = document.newCal.calName.value;
    $.post("http://www.hcs.harvard.edu/projectx/hidden/addCal.php", {calName: newName} );
    document.newCal.calName.value = "";
}

function addEvent()
{
    var newName = document.newEvent.name.value;
    var newDate = document.newEvent.date.value;
    var newLoc = document.newEvent.location.value;
    var newTime = document.newEvent.time.value;
    var newBlurb = document.newEvent.blurb.value;
    // var newCal = document.

    $.post("hidden/addEvent.php",
	{
	    name: newName,
	    date: newDate,
	    location: newLoc,
	    time: newTime,
	    blurb: newBlurb,
//	    cal: newCal
	});

    document.newEvent.name.value = "";
    document.newEvent.date.value = "";
    document.newEvent.location.value = "";
    document.newEvent.time.value = "";
    document.newEvent.blurb.value = "";
 //   document.
}

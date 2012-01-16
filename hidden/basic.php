<?
    /*
	basic.php

	Project X - 1.15.12

	code used by most pages - the login stuff and extra methods
	(based on common.php from CS50 pset7)
    */

    // display errors and warnings but not notices
    ini_set("display_errors", true);
    error_reporting(E_ALL ^ E_NOTICE);

    // enable sessions, restricting cookie to /~username/projectx/
    if (preg_match("{^(/~[^/]+/projectx/)}", $_SERVER["REQUEST_URI"], $matches))
	session_set_cookie_params(0, $matches[1]);
    session_start();

    require_once('extraMethods.php');

/*    // require authentication (AKA user logged-in) for most pages
    if (!preg_match("{/(:login|logout|register)\d*\.php$}", $_SERVER["PHP_SELF"]))
    {
	if (!isset($_SESSION["id"]))
	    redirect("login.php");
    }
*/
    // global variables

    define("DB_NAME", "projectx");
    define("DB_PASSWORD", "");
    define("DB_SERVER", "mysql.hcs.harvard.edu");
    define("DB_USERNAME", "projectx");


    if (($connection = @mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD)) === false)
        apologize("Could not connect to database server.");

    // select database
    if (@mysql_select_db(DB_NAME, $connection) === false)
        apologize("Could not select database (" . DB_NAME . ").");
?>

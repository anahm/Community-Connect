<?
    require_once("hidden/basic.php");

    // escape username to avoid SQL injection attacks
    $useremail = mysql_real_escape_string($_POST["email"]);

    // prepare SQL
    $sql = "SELECT * FROM users WHERE email='$useremail'";

    // execute query
    $result = mysql_query($sql);

    // if we found user, check password
    if (mysql_num_rows($result) == 1)
    {
        // grab row
        $row = mysql_fetch_array($result);

        // compare hash of user's input against hash that's in database
        if (crypt($_POST["password"], $row["passwordHash"]) == $row["passwordHash"])
        {
            // remember that user's now logged in by caching user's ID in session
            $_SESSION["id"] = $row["userID"];

            // redirect to homepage
            redirect("index.php");
        }
    }

    // else report error
    apologize("Invalid username and/or password!");

?>

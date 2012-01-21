<?
    require_once("hidden/basic.php");

    // validate submission
    if (empty($_POST["email"]) || empty($_POST["password"]) || ($_POST["password"] != $_POST["password2"]))
    {
        redirect("login.php");
        exit;
    }

    // escape username string to avoid SQL injection attacks
    $email = mysql_real_escape_string($_POST["email"]);

    // encrypting the submitted password
    $hash = crypt($_POST["password"]);

    // execute query to insert new user into users table
    $result = mysql_query("INSERT INTO users (email, passwordHash) 
     VALUES ('$email', '$hash')");

    // if insert fails, new username cannot be made and error is reported
    if (!$result)
        apologize("Username already taken!");

    // remember that user's now logged in by caching user's ID in session
    $id = mysql_insert_id();
    $_SESSION["id"] = $id;

    // redirect to portfolio
    redirect("index.php");

?>


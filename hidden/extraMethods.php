<?
    /*
	logout()

	logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */

    function logout()
    {
        // unset any session variables
        $_SESSION = array();

        // expire cookie
        if (isset($_COOKIE[session_name()]))
        {
            if (preg_match("{^(/~[^/]+/pset7/)}", $_SERVER["REQUEST_URI"], $matches))
                setcookie(session_name(), "", time() - 42000, $matches[1]);
            else
                setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

   /*
    * redirect($destination)
    *
    * must be called before caller outputs any html
    */

    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^http:\/\//", $destination))
            header("Location: " . $destination);

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (@$_SERVER["HTTPS"]) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // addapted from http://www.php.net/header
            $protocol = (@$_SERVER["HTTPS"]) ? "https" : "http";

	    $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exist immediately since redirecting
        exit;
    }

    /*
     * void
     * apologize($message)
     *
     * Apologizes to user by displaying a page with message.
     */

    function apologize($message)
    {
        require_once("apology.php"); 

        // exit immediately since we're apologizing
        exit;
    }
?>

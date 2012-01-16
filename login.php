<?

    // require basic code
    require_once("hidden/basic.php");

?>

<!DOCTYPE html>

<html>

  <head>
    <link href="css/styles2.css" rel="stylesheet" type="text/css">
    <title>Project X | Login</title>
  </head>

  <body>
	<div id="middle">
      	    <form action="login2.php" method="post">
        	<table>
          	    <tr>
            		<td>Email:</td>
            		<td><input name="email" type="text"></td>
          	    </tr>
          	    <tr>
            		<td>Password:</td>
            		<td><input name="password" type="password"></td>
          	    </tr>
          	    <tr>
            		<td colspan="2">
			    <input type="submit" value="Log In"></td>
          	    </tr>
        	</table>
      	    </form>
    	</div>

    <div id="bottom">
        or <a href="register.php">register</a> for an account
    </div>

  </body>

</html>

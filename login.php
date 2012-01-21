<?

    // require basic code
    require_once("hidden/basic.php");

?>

<!DOCTYPE html>

<html>

  <head>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
    <link rel="stylesheet" href="css/loginStyle.css" type="text/css" />
		<link rel="stylesheet" href="jquery-ui-1.8.17.custom/css/ui-lightness/jquery-ui-1.8.17.custom.css" />
		
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
		<script type='text/javascript' src='jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js'></script>
		<script type='text/javascript' src='jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js'></script>
		
		<script>
			$(function() {
				$("input:submit, a").button();
				$("input:submit").css("padding", "0px 5px 0px 5px");
				$("input:submit, a").css("font-size", "16px");
			});
			
			function showRegistration() {
				$("#register").html(
					'<form action="register2.php" method="post"><label style="font-weight:bold">Register for an Account</label><label>Email</label><input type="text" name="email" id="reg_email" class="text ui-widget-content ui-corner-all" /><label>Password</label><input type="password" name="password" id="reg_password" class="text ui-widget-content ui-corner-all" /><label>Password Confirmation</label><input type="password" name="password2" id="reg_password2" class="text ui-widget-content ui-corner-all" /><input type="submit" value="Register"></form>'
				);
				
				$("input:submit").button();
				$("input:submit").css("padding", "0px 5px 0px 5px");
				$("input:submit").css("font-size", "16px");
			}
		</script>
		
    <title>Project X | Login</title>
  </head>

  <body>
      <img src="images/loginyo.png" alt="Welcome!" id="test"/>
  <div id="parent">
    <div id="input">
      <form action="login2.php" method="post">
        <table class="bubble">
          <th colspan="2">
            <label style="font-weight:bold">Sign In</label>
          </th>
          <tr>
            <td>
			        <label>Email</label>
            </td>
            <td>
              <input type="text" name="email" id="login_email" class="text ui-widget-content ui-corner-all" />
            </td>
          </tr>
          <tr>
            <td>
              <label>Password</label>
            </td>
            <td>
              <input type="password" name="password" id="login_password" class="text ui-widget-content ui-corner-all" />
            </td>
          </tr>
          <tr>
            <td></td>
            <td align="right">
              <input type="submit" value="Sign In">
            </td>
          </tr>
          <tr><td></td><td></td></tr>
          <tr><td></td><td></td></tr>
          <tr><td></td><td></td></tr>
        </form>
      </table>

      <table class="bubble">
        <form action="register2.php" method="post">
          <th colspan="3">
            <label style="font-weight:bold">Register</label>
          </th>
          <tr>
            <td>
              <label>Email</label>
            </td>
            <td>
              <input type="text" name="email" id="reg_email" class="text ui-widget-content ui-corner-all" />
            </td>
            </tr>
          <tr>
            <td>
              <label>Password</label>
            </td>
            <td>
              <input type="password" name="password" id="reg_password" class="text ui-widget-content ui-corner-all" />
            </td>
          </tr>
          <tr>
            <td>
              <label>Confirm Password</label>
            </td>
            <td>
              <input type="password" name="password2" id="reg_password2" class="text ui-widget-content ui-corner-all" />
            </td>
          <tr>
            <td></td>
            <td align="right">
              <input type="submit" value="Register">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  </body>

</html>

<?

    // require basic code
    require_once("hidden/basic.php");

?>

<!DOCTYPE html>

<html>

  <head>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
		<link rel="stylesheet" href="css/styles2.css" type="text/css" />
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
	<div id="login_form" class="bubble">
		<form action="login2.php" method="post">
			<label style="font-weight:bold">Login In</label>
			<label>Email</label>
			<input type="text" name="email" id="login_email" class="text ui-widget-content ui-corner-all" />
			<label>Password</label>
			<input type="password" name="password" id="login_password" class="text ui-widget-content ui-corner-all" />
			<input type="submit" value="Log In">
		</form>
	</div>
	
	<div id="register" class="bubble">
		<a href="#" onclick="showRegistration()">register</a>
	</div>
  </body>

</html>

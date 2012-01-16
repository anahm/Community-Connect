<?
    require_once("hidden/basic.php");
?>

<!DOCTYPE html>

<html>

  <head>
    <link href="css/styles2.css" rel="stylesheet" type="text/css">
    <title>Project X |  Registration</title>
  </head>

  <body>
    <div id="middle">
      <form action="register2.php" method="post">
        <table style="text-align: right">
          <tr>
            <td>Email:</td>
            <td><input name="email" type="text"></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><input name="password" type="password"></td>
          </tr>
          <tr>
            <td>Password Confirmation:</td>
            <td><input name="password2" type="password"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" value="Register"></td>
          </tr>
        </table>
      </form>
    </div>

    <div id="bottom">
        <br>
        or <a href="login.php">log in</a> if you already have an account
    </div>

  </body>

</html>


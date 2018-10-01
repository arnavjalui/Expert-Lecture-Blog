<?php
//include config
require_once('includes/functions.php');

if ((isset($_SESSION['user_id']))) {
    header('Location: profile.php');
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="style/normalize.css">
  <link rel="stylesheet" href="style/main.css">
</head>
<body>

<?php include('menu2.php');?>
<div id="login">

	<form action="includes/functions.php" method="POST">
	<p><label>Email</label><input type="text" name="Email" value=""  /></p>
	<p><label>Password</label><input type="password" name="Password" value=""  /></p>
	<p><label></label><input type="submit" name="login_submit" value="Login"  /></p>
	</form>

</div>
</body>
</html>

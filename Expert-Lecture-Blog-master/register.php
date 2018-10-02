<?php //include config
require_once('includes/functions.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="style/normalize.css">
  <link rel="stylesheet" href="style/main.css">
</head>
<body>

<div id="wrapper">

	<?php include('menu2.php');?>

	<h2>Register for the blog</h2>

	<form action='includes/functions.php' method='POST'>

		<p><label>First name</label><br />
		<input type='text' name='first_name' value=''></p>

		<p><label>Last name</label><br />
		<input type='text' name='last_name' value=''></p>

		<p><label>Password</label><br />
		<input type='password' name='password' value=''></p>

		<p><label>Email</label><br />
		<input type='text' name='email' value=''></p>
		
		<p><input type='submit' name='register_submit' value='Register Now!'></p>

	</form>

</div>

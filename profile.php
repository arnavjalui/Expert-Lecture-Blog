<?php

require_once('includes/functions.php');
if (!(isset($_SESSION['user_id']))) {
    header('Location: login.php');
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

<?php include('menu.php');?>
<?php 
	$name = $_SESSION['user_name']; 
	echo "<h1>Hello ".$name."</h1>";
?>
</div>
</body>
</html>

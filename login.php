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
<div class="wrapper">
<?php include('menu2.php');?>
<div id="login">

	<form action="includes/functions.php" method="POST">
    	<p><label><pre>Email:    </label><input type='email' name='Email' id="email" value='' required oninput="checkUsername(this)"></p></pre>
    	<p><label><pre>Password: </label><input type="password" name="Password" value="" required="" /></p></pre>
    	<p><label></label><input type="submit" name="login_submit" value="Login"  /></p>
    </form>

</div>
</div>
</body>
</html>

<script type="text/javascript">
    function checkUsername(email)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                if(this.responseText=='')
                {    
                    var elem = document.getElementById("email");
                    elem.setCustomValidity("Email not registered. Please register before logging in.");
                    elem.reportValidity();

                }
                else
                {
                    var elem = document.getElementById("email");
                    elem.setCustomValidity("");
                }
            };
        }
        xhttp.open("POST", "includes/functions.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("check_email="+email.value);
    }

    function clearValidation(email)
    {
        var elem = document.getElementById("email");
        elem.setCustomValidity("");
    }
</script>

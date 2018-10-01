<?php
session_start();
error_reporting(0);
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "pass@123";
$dbName = "blog";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die('Could not connect: ' . mysql_error());
}


if (isset($_POST['login_submit'])) {
	userlogin($conn);
} elseif (isset($_POST['register_submit'])) {
	usersignup($conn);
}


function userlogin($conn){
	if (isset($_POST['login_submit'])) {
		$email=mysqli_real_escape_string($conn, $_POST['Email']);
		$password=mysqli_real_escape_string($conn, $_POST['Password']);

		$sql = "SELECT * FROM blog_members WHERE blog_members.email='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			//USER NOT FOUND ERROR
			header('Location: ../login.php?user_login=true&user_not_found=true');
		} else if ($resultCheck==1) {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPwdCheck = password_verify($password, $row['password']);
				if ($hashedPwdCheck == false) {
							//INCORRECT PASSWORD ERROR
					header('Location: ../login.php?user_login=true&login_error=true');
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['user_name'] = $row['first_name'].' '.$row['last_name'];
					
					// $uid = $_SESSION['user_id'];
					// $sql2 = "SELECT * FROM seller WHERE seller.user_id='$uid'";
					// $result2 = mysqli_query($conn, $sql2);
					// $row2 = mysqli_fetch_assoc($result2);
					// $_SESSION['seller_id']=$row2['seller_id'];
					
					// date_default_timezone_set("Asia/Kolkata");
					// if (isset($_SESSION['user_id']) && ($rememberme==1)) {
					// 	$cookievalue = $_COOKIE['PHPSESSID'];
					// 	setcookie("PHPSESSID",$cookievalue,time()+(3600*24*2),"/");
					// }
					header('Location: ../profile.php');
				}
			}
		}
	}
}



function usersignup($conn) {
	if (isset($_POST['register_submit'])) {
		
		$fname=mysqli_real_escape_string($conn, $_POST['first_name']);
		$lname=mysqli_real_escape_string($conn, $_POST['last_name']);
		$email=mysqli_real_escape_string($conn, $_POST['email']);
		$password=mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_DEFAULT));
		$sql="SELECT * FROM blog_members WHERE blog_members.email='$email'";
		$result=mysqli_query($conn, $sql);
		if($result) {
			$num_row= mysqli_num_rows($result);
			if ($num_row==0) {
				$sql="INSERT INTO blog_members (first_name, last_name, email, password) VALUES ('$fname','$lname','$email','$password')";
				$result2 = mysqli_query($conn, $sql);
				if ($result2) {
					header('Location: ../login.php?registration=true&reg_success=true');
				} elseif (!$result2) {
					header('Location: ../register.php?registration=true&reg_fail=true');
				}
				
			} else {
				//show error for user exists
				header('Location: ../login.php?registration=true&userexists=true');
			}
		} else {
			//Registration failed
			header('Location: ../login.php?registration=true&customer_reg_error=true');
		}
	}
}
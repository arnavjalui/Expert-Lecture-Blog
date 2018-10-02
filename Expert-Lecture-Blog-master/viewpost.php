<?php require('includes/functions.php'); 

if (!(isset($_SESSION['user_id']))) {
    header('Location: login.php');
}

//$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
//$stmt->execute(array(':postID' => $_GET['id']));
//$row = $stmt->fetch();

$pID = $_GET['id'];
$sql1 = "SELECT postID, postTitle, postDate, postCont FROM blog_posts WHERE postID = '$pID'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_array($result);

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>
		<hr />
		<p><a href="./">Blog Index</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'.$row['postTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
				echo '<p>'.$row['postCont'].'</p>';				
			echo '</div>';
		?>

	</div>

</body>
</html>
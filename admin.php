<?php
//include config
require_once('includes/functions.php');
if (!(isset($_SESSION['user_id']))) {
    header('Location: login.php');
}
//require_once('../includes/functions.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){ 

	// $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	// $stmt->execute(array(':postID' => $_GET['delpost']));

	$pid = $_GET['delpost'];
	$sql = "DELETE FROM blog_posts WHERE postID = '$pid' ";
	if(mysqli_query($conn, $sql)){
    				echo "Records inserted successfully.";
					} else{
    					echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
					}
 


	header('Location: index.php?action=deleted');
	exit;
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="style/normalize.css">
  <link rel="stylesheet" href="style/main.css">
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'index.php?delpost=' + id;
	  }
  }
  </script>
</head>
<body>

	<div id="wrapper">

	<?php include('menu.php');?>

	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Post '.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table>
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			//$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');

			$uid = $_SESSION['user_id'];
			$sql1 = "SELECT postID, postTitle, postDate FROM blog_posts WHERE user_id='$uid' ORDER BY postID DESC";

			$result = mysqli_query($conn, $sql1);
			while($row = mysqli_fetch_array($result)){
				
				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-post.php'>Add Post</a></p>

</div>

</body>
</html>

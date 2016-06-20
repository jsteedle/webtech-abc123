<?php 
  // Likes Page - Assignment 1 by Jesse Steedle

	//error_reporting(E_ALL);
	//ini_set('display_errors', TRUE);

	//include('database.php');
	include ('feed.php');
	//connect to DB
	$conn = connect_db();
	//get data from the form
	$UID = $_POST['UID'];
	//query DB for this Post
	$result = mysqli_query($conn, "SELECT * FROM posts WHERE UID='$UID'");
	$row = mysqli_fetch_assoc($result);
	$likes = $row['likes'];
	//update likes
	$likes = $likes + 1;
	echo $likes;
	$result = mysqli_query($conn, "UPDATE posts SET likes='$likes' WHERE UID='$UID'");
	if($result){
		header('Location: feed.php');
	}else{
		echo "Something is wrong!";
	}
 ?>

<?php
	// Comments Page - Assignment 1 by Jesse Steedle
	//error_reporting(E_ALL);
	//ini_set('display_errors', TRUE);

	include('functions.php');
	include('database.php');
	session_start();

	//Get data from the form
	$content = $_POST['content'];
	$post_ID = $_POST['post_ID'];
	
	//Scrub the User Input from posts
	$content = sanitizeString($content);
	$post_ID = sanitizeString($post_ID);
	
	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$post_ID'");
	$row = mysqli_fetch_assoc($result);

	//Fetch User information	
	$name = $row["name"];
	$profile_pic = $row["profile_pic"];
	$likes = $row['likes'];

	$result_insert = mysqli_query($conn, "INSERT INTO comments(content, UID, name, profile_pic, likes, created_at) VALUES ('$content', '$post_ID', '$name', '$profile_pic', '$likes', now())");

	//check if insert was okay
	if($result_insert){
		//redirect to feed page 
		header("Location: feed.php");
	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
 
?>

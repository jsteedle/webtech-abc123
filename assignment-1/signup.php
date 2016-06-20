<?php
//* SignUp php - Assignment 1 by Jesse Steedle */

	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);

	include ('feed.php');
	//start session
	session_start();	
	//get username and password from $_POST
	$username = $_POST["username"];
	
	$password = $_POST["password"];
	// Hash the password
	$password = password_hash($password, PASSWORD_DEFAULT);
	//echo $password;

	$name = $_POST["name"];
	$email = $_POST["email"];
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	$question = $_POST["question"];
	$answer = $_POST["answer"];
	$location = $_POST["location"];
	$profile_pic = $_POST["profile_pic"];

	// Scrub User Input
	$username = sanitizeString($username);
	$name = sanitizeString($name);
	$email = sanitizeString($email);
	$dob = sanitizeString($dob);
	$gender = sanitizeString($gender);
	$question = sanitizeString($question);
	$answer = sanitizeString($answer);
	$location = sanitizeString($location);
	$profile_pic = sanitizeString($profile_pic);


	// Set the database 
	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";

	// connect to myDB
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// Insert a new user into users table
	$result_insert = mysqli_query($conn, "INSERT INTO users(`Username`, `Password`, `Name`, `email`, `dob`, `gender`, `verification_question`, `verification_answer`, `location`, `profile_pic`) VALUES ('$username', '$password', '$name', '$email', '$dob', '$gender', '$question', '$answer', '$location', '$profile_pic')");

	if($result_insert){
		//redirect to feed page 
		$_SESSION["username"] = $username;
		header('Location: feed.php');
	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
?>

<?php
/* SignUp php - Assignment 1 by Jesse Steedle */
		
	//start session
	session_start();	
	//get username and password from $_POST
	$u = $_POST["username"];
	
	$pw = $_POST["password"];
	// Hash the password
	$password = password_hash($pw, PASSWORD_DEFAULT); 

	$n = $_POST["name"];
	$e = $_POST["email"];
	$d = $_POST["dob"];
	$g = $_POST["gender"];
	$q = $_POST["question"];
	$a = $_POST["answer"];
	$l = $_POST["location"];
	$pp = $_POST["profile_pic"];

	// Scrub User Input
	$username = sanitizeString($u);
	$name = sanitizeString($n);
	$email = sanitizeString($e);
	$dob = sanitizeString($d);
	$gender = sanitizeString($g);
	$question = sanitizeString($q);
	$answer = sanitizeString($a);
	$location = sanitizeString($l);
	$profile_pic = sanitizeString($pp);


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
	$result_insert = mysqli_query($conn, "INSERT INTO users(Username, Password, Name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username', $password, '$name', '$email', '$dob', 'gender', 'question', 'answer', 'location', 'profile_pic')");
	//$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

	if($result_insert){
		//redirect to feed page 
		header("Location: feed.php");
	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
?>

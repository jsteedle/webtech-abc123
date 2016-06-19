
<?php
	/* Login php - Assignment 1 by Jesse Steedle */
		
	include ('functions.php');
	//start session
	session_start();	
	//get username and password from $_POST
	$u = $_POST["username"];
	// Scrub the username
	$username = sanitizeString($u);
	$password = $_POST["password"];

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";
	
	// Connect to myDB
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	
	// check for results returned
	$num_of_rows = mysqli_num_rows($result);

	if($num_of_rows > 0){
		// fetch the hashed password from Db
		$row = mysqli_fetch_assoc($result);
		$pw_hash = $row['password'];
		//verify the password vs the hash
		if (password_verify($password, $pw_hash))
		{
			//If authenticated: redirect to Feed page
			$_SESSION["username"] = $username;
			header("Location: feed.php");
	
		}else{
			// password does not match
			echo "Invalid password! Try again!";
		}
	}else{
		// user not found in db
		echo "User not Found.  Try again.";
	}

}
?>


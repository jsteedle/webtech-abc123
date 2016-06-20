
<!DOCTYPE html>
<!-- Feed Page - Assignment 1 by Jesse Steedle -->
<html>
<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	//include('functions.php');
		
	session_start();
	// Connect to DB and get username from Session
	$conn = connect_db();
	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	//user information 
	$row = mysqli_fetch_assoc($result);
	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";
	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Post here...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";
	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);
	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}
	
	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){
		$row = mysqli_fetch_row($result_posts);
		echo "$row[2] said: $row[0]. ";
		echo "<br>";
		echo "Likes ($row[4])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='UID' value='$row[1]'> <input type='submit' value='Like'></form>";
		echo "<br>";
	}
?>
</body>
</html>

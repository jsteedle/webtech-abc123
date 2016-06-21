

<!DOCTYPE html>
<!-- Feed Page - Assignemnt 1 by Jesse Steedle -->
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
	//echo $username;
	$result = mysqli_query($conn, "SELECT * FROM users WHERE Username='$username'");
	//user information 
	$row = mysqli_fetch_assoc($result);

	echo "<div class=\"container\" >";
	echo "<div class=\"col-sm-6 col-md-4 col-md-offset-4\">";
	echo "<div>"; 

	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";
	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Post here...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";

	echo "</div>";
	echo "</div>";
	echo "</div>";
	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<div class=\"container\" >";
	echo "<div class=\"col-sm-6 col-md-4 col-md-offset-4\">";
	echo "<div>"; 

	echo "<h2>My Feed</h2>";
	echo "</div>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){
		$row = mysqli_fetch_row($result_posts);
		echo "$row[3] said: $row[1]. ";
		echo "<br>";
		echo "Likes ($row[5])";

		echo "<h4>Comments</h4>";
		$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE UID= $row[0]");
		$num_of_comment_rows = mysqli_num_rows($result_comments);
		for($j = 0; $j < $num_of_comment_rows; $j++){
			$row_comment = mysqli_fetch_row($result_comments);
			echo "Comment from $row_comment[3]: ";
			echo "$row_comment[1]";
		}
		
		echo "<form method='POST' action='comments.php'>";
		echo "<p><textarea name='content'>Comment...</textarea></p>";
		echo "<input type='hidden' name='post_ID' value='$row[0]'>";
		echo "<p><input type='submit'></p>";	
		echo "</form>";
		echo "<br>";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='UID' value='$row[2]'> <input type='submit' value='Like'></form>";
		echo "<br>";
		echo "<hr>";
	}
	echo "</div>";
	echo "</div>";

?>
	<div>
	<form action="logout.php"><input type="submit" value="logout" /></form>
	</div>
	<!-- <a href='logout.php'>Click here to log out</a> -->
	</div>
</body>
</html>

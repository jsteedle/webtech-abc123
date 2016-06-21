<?php
	// Logout redirect to Login page - Assignment 1 by Jesse Steedle

	include ('functions.php');

	destroySession();

	header("Location: login.html");


?>

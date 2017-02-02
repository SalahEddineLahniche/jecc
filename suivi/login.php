<?php
	session_start(); // Starting Session
	if (isset($_POST['login'])) {
		if (empty($_POST['user']) || empty($_POST['pass'])) {
			header("location: success.php?code=2"); // Redirecting To Other Page
		}
		else
		{
			require 'functions.php';
			// // Define $username and $password
			$username=$_POST['user'];
			$password=$_POST['pass'];
			$redirect=$_GET['redirect'];
			if (!isset($redirect) || $redirect == "") {
				$redirect = "index";
			}
			if (test_user($username, $password)) {
				$_SESSION['login_email']=$username; // Initializing Session
				header("location: $redirect.php"); // Redirecting To Other Page
			} else {
				header("location: success.php?code=2"); // Redirecting To Other Page
			}
			mysql_close($connection); // Closing Connection

		}
	}
?>
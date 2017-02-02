<?php
	if (isset($_POST['register'])) {
		if (empty($_POST['email']) || empty($_POST['password'])) {
			header("location: success.php?code=2"); // Redirecting To Other Page
		}
		else
		{
			require 'functions.php';
			// // Define $username and $password
			$data['username']=$_POST['name'];
			$data['password']=$_POST['password'];
			$data['email']=$_POST['email'];
			$data['role']=$_POST['role'];
			// echo($_POST['dep']);
			// die(get_departement_id($_POST['dep']));
			$data['departement_id']=get_departement_id($_POST['dep']);
			if (add_user($data)) {
				header("location: success.php?code=5"); // Redirecting To Other Page
			} else {
				header("location: success.php?code=6"); // Redirecting To Other Page
			}
			mysql_close($connection); // Closing Connection

		}
	}
?>
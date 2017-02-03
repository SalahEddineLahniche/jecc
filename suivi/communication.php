<?php
	// include('login.php');
	include('session.php');
	if (!isset($activated)) {
		header("location: success.php?code=4");
	}
	if ($activated == "0") {
		header("location: success.php?code=3");
	}
?>
<!DOCTYPE html>
<html>
	<?php require 'head.php';?>
	<body>
		<?php $active = 5; require 'header.php';?>
		<?php $redirect = "communication"; require 'login-form.php';?>

		<?php $departement_id = 4; require 'posts.php';?>

		<?php require 'footer.php';?>
	</body>
</html>

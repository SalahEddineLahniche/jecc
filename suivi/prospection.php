<?php
	// include('login.php');
	include('session.php');
	if (!isset($activated)) {
		header("location: success.php?code=4");
	}
	if ($activated == "0")
	{
		header("location: success.php?code=3");
	}
?>
<!DOCTYPE html>
<html>
	<?php require 'head.php';?>
	<body>
		<?php $active = 4; require 'header.php';?>
		<?php $redirect = "prospection"; require 'login-form.php';?>



		<?php require 'footer.php';?>
	</body>
</html>

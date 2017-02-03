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

    if ($_POST['update']) {
        $user_id = $_POST['user_id'];
        $activated = $_POST['activated'];
        if($role == 'toor') {
            $status = activate_user($user_id, $activated);
            if ($status)
                die('1');
            else
                die('0');
        }
    }
?>
<!DOCTYPE html>
<html>
	<?php require 'head.php';?>
	<body>
		<?php $active = 0; require 'header.php';?>
		<?php $redirect = "admin"; require 'login-form.php';?>
        <?php $users = get_users(); require 'dashboard.php';?>

		<?php require 'footer.php';?>
	</body>
</html>

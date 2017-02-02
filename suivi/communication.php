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

		<div class="container">
			<div class="new-post">
				<div class="new-post-content">
					<textarea class="form-control text-content" rows="3" max-length="400"></textarea>
					<button type="button" class="btn btn-primary">Submit</button>
					<span>400</span>
				</div>
			</div>
		</div>
		<div class="container posts">
			<div class="post">
				<div class="name">
					<span class="role">Chef de projet :</span>
					<span class="full-name">Salah Eddine Lahniche</span>
					<span class="date">10 September 2016</span>
				</div>
				<div class="content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto quaerat enim, cupiditate quasi laborum quibusdam esse itaque iure eius ratione. Alias ipsam, blanditiis quibusdam. Inventore voluptates porro sit nam dolor iste, quaerat reiciendis numquam minus aspernatur odio quo quos quibusdam nisi ipsum error eligendi velit. Tenetur deleniti iure, neque officiis.
				</div>
				<div class="attachment">
					<div class="link-image glyphicon glyphicon-link"></div>
					<div class="link-content"><a href="https://www.jecc.ma">https://jecc.ma</a></div>
				</div>
			</div>

			<div class="post">
				<div class="name">
					<span class="role">Chef de projet :</span>
					<span class="full-name">Salah Eddine Lahniche</span>
					<span class="date">10 September 2016</span>
				</div>
				<div class="content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto quaerat enim, cupiditate quasi laborum quibusdam esse itaque iure eius ratione. Alias ipsam, blanditiis quibusdam. Inventore voluptates porro sit nam dolor iste, quaerat reiciendis numquam minus aspernatur odio quo quos quibusdam nisi ipsum error eligendi velit. Tenetur deleniti iure, neque officiis.
				</div>
				<div class="attachment">
					<div class="link-image glyphicon glyphicon-link"></div>
					<div class="link-content"><a href="https://www.jecc.ma">https://jecc.ma</a></div>
				</div>
			</div>
		</div>

		<?php require 'footer.php';?>
	</body>
</html>

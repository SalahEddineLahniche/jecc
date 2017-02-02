<?php
	// include('login.php');
	include('session.php');
	// if ($activated == "0")
	// {
	// 	header("location: success.php?code=3");
	// }
?>
<!DOCTYPE html>
<html>
	<?php require 'head.php';?>
	<body>
		<?php require 'header.php';?>
		<?php require 'login-form.php';?>

		<div class="jumbotron">
			<div class="container">
				<h1>Suivi de la JECC</h1>
				<p>C'est une plate-forme pour le Suivi de la Junior Entreprise de L'Ecole Centrale Casablanca. Son but est assurer une communication continue, précise et efficace au sein de la JECC</p>
			</div>
		</div>

		<div class="container poles">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<a href="general.php">
					<div class="pole">
						<h1>Générale</h1>
					</div>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<a href="projets.php">
					<div class="pole">
						<h1>Project</h1>
					</div>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<a href="confederation.php">
					<div class="pole">
						<h1>Confédération</h1>
					</div>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<a href="prospection.php">
					<div class="pole">
						<h1>Prospection</h1>
					</div>
				</a>
			</div>

			<div class="col-lg-offset-4 -col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<a href="communication.php">
					<div class="pole">
						<h1>Communication</h1>
					</div>
				</a>
			</div>
		</div>

		<?php require 'footer.php';?>
	</body>
</html>

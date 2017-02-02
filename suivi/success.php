<?php
	// include('login.php');
	include('session.php');
?>
<!DOCTYPE html>
<html>
	<?php require 'head.php';?>
	<body>
		<?php require 'login-form.php';?>
		<?php require 'header.php';?>
		<div class="container">
			<?php if($_GET["code"] == "1") { ?>
				<div class="alert alert-success">
				  <strong>Réussite !</strong> Votre demande va être traité par le bureau de la JECC, et nous vous contacterons prochainement. Merci pour votre attente.
				</div>
			<?php } else if ($_GET["code"] == "2") {?>
				<div class="alert alert-danger">
				  <strong>Erreur</strong> nom d'utilistateur ou mot de passe est incorrecte.
				</div>
			<?php } else if ($_GET["code"] == "3") {?>
				<div class="alert alert-danger">
				  <strong>Erreur</strong> Ton compte n'est pas encore activé, si cela dure longtemps, veuillez contacter l'administrateur junior.entreprise@centrale-casablanca.ma.
				</div>
			<?php } else if ($_GET["code"] == "4") {?>
				<div class="alert alert-danger">
				  <strong>Erreur</strong> Vous n'avez pas le droit de voir l'état d'avancement si vous n'êtes pas un membre, veuillez se connecter s'il vous plaît.
				</div>
			<?php } else if ($_GET["code"] == "5") {?>
				<div class="alert alert-success">
				  <strong>Réussite !</strong> Votre demande à été deposé avec succès, veuillez revenir ultérieurement.
				</div>
			<?php } else if ($_GET["code"] == "6") {?>
				<div class="alert alert-danger">
				  <strong>Erreur !</strong> Une erreur est survenu lors de la creation du compte veuillez reessayer. Si le problème persiste veuillez contacter l'administrateur junior.entreprise@centrale-casablanca.ma.
				</div>
			<?php
			} ?>
		</div>
		<?php require 'footer.php';?>
	</body>
</html>

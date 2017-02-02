<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="loginmodal-container">
			<h1>Se Connecter à ton compte</h1><br>
			<form action=<?php echo "\"login.php?redirect=$redirect\"";?> method="post">
				<input type="text" name="user" placeholder="e-mail">
				<input type="password" name="pass" placeholder="mot de passe">
				<input type="submit" name="login" class="login loginmodal-submit" value="Se Connecter">
			</form>
			<div class="login-help">
				<a href="signup.php">Créer un compte</a> - <a href="#">J'ai oublié mon mot de passe</a>
			</div>
		</div>
	</div>
</div>
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
			<div class="row main">
				<div class="main-login main-center">
					<form class="form-horizontal" id="register" method="post" action="register.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Nom</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="Entrer ton nom"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">E-mail</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Entrer ton e-mail"/>
								</div>
							</div>
						</div>

						<div class="form-group">
						  <label for="dep" class="cols-sm-2 control-label">Departement</label>
						  <div class="cols-sm-10">
						  	<div class="input-group">
						  		<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
								<select class="form-control" id="dep" name="dep" placeholder="Selectionner ton departement">
								  <option>Générale</option>
								  <option>Projets</option>
								  <option>Confédération</option>
								  <option>Prospection</option>
								</select>
						  	</div>
						  </div>
						</div>

						<div class="form-group">
							<label for="role" class="cols-sm-2 control-label">Role</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="role" id="role"  placeholder="Entrer ton role dans la JECC"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Mot de passe</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Entrer un mot de passe"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirmation de mot de passe</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirmer un mot de passe"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="register" id="register">Créer compte</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php require 'footer.php';?>
	</body>
</html>
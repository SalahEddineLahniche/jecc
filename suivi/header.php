<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">
				<img src="../img/brand.png" alt="Brand">
			</a>
			<a href="index.php" class="navbar-brand text-brand">Suivi</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav" data-active="<?= $active;?>">
				<li <?php if($active == 1) {echo "class=\"active\"";}?> ><a href="general.php">Générale</a></li>
				<li <?php if($active == 2) {echo "class=\"active\"";}?> ><a href="projets.php">Projets</a></li>
				<li <?php if($active == 3) {echo "class=\"active\"";}?> ><a href="confederation.php">Confédération</a></li>
				<li <?php if($active == 4) {echo "class=\"active\"";}?> ><a href="prospection.php">Prospection</a></li>
				<li <?php if($active == 5) {echo "class=\"active\"";}?> ><a href="communication.php">Communication</a></li>
			</ul>
			<p class="navbar-text navbar-right actions">
			<?php 
				if(isset($_SESSION['login_email'])){
					echo 'Welcome <a class="navbar-link" data-id="' . $id . '" data-role="' . $role . '" href="' . $departement . '.php">' . $name . '</a> !';
					echo '<a class="navbar-link" href="signout.php"> Se deconnecter</a>';
					// header("location: {$_SESSION['departement']}.php");
				}
				else
				{
					echo '<a class="navbar-link login" href="#" data-toggle="modal" data-target="#login-modal">Se connecter</a>';
				}
			 ?>
				<!-- <a class="btn btn-default action-button" role="button" href="#">Sign Up</a> -->
			</p>
		</div>
	</div>
</nav>
		
<?php
	session_start();
	require 'functions.php';
	$infos = get_user_infos($_SESSION['login_email']);
	$name = $infos['name'];
	$departement = $infos['departement'];
	$activated = $infos['activated'];
	// header('Location: index.php'); // Redirecting To Home Page
?>
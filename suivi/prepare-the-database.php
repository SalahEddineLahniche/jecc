<?php 
	$dbhost = 'localhost:3306';
	$dbuser = 'jecc';
	$dbpass = 'ccej';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);

	if(! $conn ) {
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';

	$sql = 'CREATE Database jecc_suivi';
	$retval = mysql_query( $sql, $conn );	
	if(! $retval ) {
		die('Could not create database: ' . mysql_error());
	}
	mysql_select_db('jecc_suivi');
	$sql = 'CREATE TABLE IF NOT EXISTS `users` ( `id` int(11) NOT NULL, `uname` text NOT NULL, `email` text NOT NULL, `password` text NOT NULL, `role` text NOT NULL, `departement_id` int(11) NOT NULL, `activated` int(11) NOT NULL);';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not create table users: ' . mysql_error());
	}
	$sql = 'ALTER TABLE `users` ADD PRIMARY KEY (`id`);';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not set id as a primary key in users: ' . mysql_error());
	}
	$sql = 'INSERT INTO `jecc_suivi`.`users` (`id`, `uname`, `email`, `password`, `role`, `departement_id`, `activated`) VALUES (\'0\', \'admin\', \'junior.entreprise@centrale-casablanca.ma\', \'JecC\', \'admin\', \'0\', \'1\');';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not create user admin: ' . mysql_error());
	}
	$sql = 'CREATE TABLE IF NOT EXISTS `posts` (`id` int(11) NOT NULL, `user_id` int(11) NOT NULL, `ptext` text NOT NULL, `plink` text NOT NULL, `departement_id` int(11) NOT NULL);';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not create table posts: ' . mysql_error());
	}
	$sql = 'ALTER TABLE `posts` ADD PRIMARY KEY (`id`);';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not set id as a primary key in posts: ' . mysql_error());
	}
	$sql = 'CREATE TABLE IF NOT EXISTS `departements` (`id` int(11) NOT NULL, `dname` text NOT NULL);';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not create table departements: ' . mysql_error());
	}
	$sql = 'ALTER TABLE `departements` ADD PRIMARY KEY (`id`);';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not set id as a primary key in departements: ' . mysql_error());
	}
	$sql = 'INSERT INTO `departements` (`id`, `dname`) VALUES (0, \'general\'), (1, \'projets\'), (2, \'confederation\'), (3, \'prospection\'), (4, \'communication\');';
	$retval = mysql_query( $sql, $conn );
	if(! $retval ) {
		die('Could not fill departements: ' . mysql_error());
	}

	echo "<br>Success !";
	mysql_close($conn);
?>
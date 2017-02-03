<?php
	$dbhost = 'localhost:3306';
	$dbuser = 'jecc';
	$dbpass = 'ccej';
	
	function encoding_fix($conn) {
		mysql_query("SET character_set_results=utf8", $conn);
    	mb_language('uni'); 
    	mb_internal_encoding('UTF-8');
    	mysql_query("set names 'utf8'",$conn);
	}

	function add_post($post) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		// To protect db from MySQL injection for Security purpose
		$post['ptext'] = stripslashes($post['ptext']);
		$post['ptext'] = mysql_real_escape_string($post['ptext']);
		$post['plink'] = stripslashes($post['plink']);
		$post['plink'] = mysql_real_escape_string($post['plink']);
		// SQL query to fetch information of registerd users and finds user match.
		$sql = "INSERT INTO `jecc_suivi`.`posts` (`user_id`, `ptext`, `plink`, `departement_id`, `pdate`) VALUES ('{$post['user_id']}', '{$post['ptext']}', '{$post['plink']}', {$post['departement_id']}, '{$post['pdate']}');";
		$retval = mysql_query($sql, $connection);
		mysql_close($connection);
		if(! $retval ) {
			return false;
		}
		return true;
	}

	function get_posts_count($departement_id) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$sql = "SELECT count(`id`) as total FROM `posts` WHERE `departement_id` = $departement_id;";
		$query=mysql_query($sql, $connection);
		$row = mysql_fetch_assoc($query);
		$rslt = $row['total'];
		mysql_close($connection);
		return $rslt;
	}

	function get_posts($departement_id, $start = -1, $length = -1) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		$add = "";
		$start = (int)$start;
		$length = (int)$length;
		if ($start > 0) {
			if ($length <= 0) {
				$length = 18446744073709551615;
			}
			$add = " LIMIT $length OFFSET $start;";
		} elseif ($length > 0) {
			$add = " LIMIT $length;";
		}
		// SQL query to fetch information of registerd users and finds user match.
		$sql = "SELECT posts.ptext, posts.pdate, posts.plink, posts.id, users.role, users.uname FROM `posts`, `users` WHERE posts.`departement_id` = $departement_id AND posts.user_id = users.id" . $add;
		$query=mysql_query($sql, $connection);
		$rslt = array();
		$row = mysql_fetch_assoc($query);
		$i = 0;
		while($row) {
			$rslt[$i]['id'] = $row['id'];
			$rslt[$i]['ptext'] = $row['ptext'];
			$rslt[$i]['plink'] = $row['plink'];
			$rslt[$i]['uname'] = $row['uname'];
			$rslt[$i]['urole'] = $row['role'];
			$rslt[$i]['pdate'] = $row['pdate'];
			$row = mysql_fetch_assoc($query);
			$i++;
		}
		mysql_close($connection);
		return $rslt;
	}

	function add_user($data) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		// To protect MySQL injection for Security purpose
		$sql = "SELECT MAX(id) as max FROM `users`";
		$retval = mysql_query( $sql, $connection );
		$rslt = mysql_fetch_assoc($retval);
		$id = intval($rslt['max']) + 1;
		$data['username'] = stripslashes($data['username']);
		$data['username'] = mysql_real_escape_string($data['username']);
		$data['password'] = stripslashes($data['password']);
		$data['password'] = mysql_real_escape_string($data['password']);
		$data['email'] = stripslashes($data['email']);
		$data['email'] = mysql_real_escape_string($data['email']);
		$data['role'] = stripcslashes($data['role']);
		$data['role'] = mysql_real_escape_string($data['role']);

		$sql = "INSERT INTO `jecc_suivi`.`users` (`id`, `uname`, `email`, `password`, `role`, `departement_id`, `activated`) VALUES ($id, '{$data['username']}', '{$data['email']}', '{$data['password']}', '{$data['role']}', '{$data['departement_id']}', '0');";
		$retval = mysql_query( $sql, $connection );
		mysql_close($connection);
		if(! $retval ) {
			return false;
		}
		return true;
		
	}

	function get_departement_id($departement) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		$departement = stripslashes($departement);
		$departement = mysql_real_escape_string($departement);
		// To protect MySQL injection for Security purpose
		$sql = "SELECT id FROM `departements` WHERE `dname` = '$departement'";
		$retval = mysql_query( $sql, $connection );
		$rslt = mysql_fetch_assoc($retval);
		mysql_close($connection);
		return $rslt['id'];
	}

	function activate_user($user_id, $activated) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		$user_id = stripslashes($user_id);
		$user_id = mysql_real_escape_string($user_id);
		$activated = stripslashes($activated);
		$activated = mysql_real_escape_string($activated);
		// SQL query to fetch information of registerd users and finds user match.
		$query=mysql_query("UPDATE `users` SET `activated` = $activated WHERE `id` = $user_id;", $connection);
		mysql_close($connection);
		if (!$query) {
			return false;
		}
		return true;
	}

	function get_users() {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query=mysql_query("SELECT `users`.`id`, `users`.`role`, `users`.`uname`, `users`.`activated` FROM `users`;", $connection);
		$row = mysql_fetch_assoc($query);
		$rslt = array();
		$i = 0;
		while($row) {
			$rslt[$i]['name'] = $row['uname'];
			$rslt[$i]['activated'] = $row['activated'];
			$rslt[$i]['id'] = $row['id'];
			$rslt[$i]['role'] = $row['role'];
			$i++;
			$row = mysql_fetch_assoc($query);
		}
		mysql_close($connection);
		return $rslt;
	}

	function user_email_exists($usr_email) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		$usr_email = stripslashes($usr_email);
		$usr_email = mysql_real_escape_string($usr_email);
		// To protect MySQL injection for Security purpose
		$sql = "SELECT email FROM `users` WHERE `email` = '$usr_email'";
		$retval = mysql_query( $sql, $connection );
		$rows = mysql_num_rows($retval);
		mysql_close($connection);
		if ($rows >= 1) {
			return true;
		} else {
			return false;
		}
	}
	function user_name_exists($usr_name) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		$usr_name = stripslashes($usr_name);
		$usr_name = mysql_real_escape_string($usr_name);
		// To protect MySQL injection for Security purpose
		$sql = "SELECT uname FROM `users` WHERE `uname` = '$usr_name'";
		$retval = mysql_query( $sql, $connection );
		$rows = mysql_num_rows($retval);
		mysql_close($connection);
		if ($rows >= 1) {
			return true;
		} else {
			return false;
		}
	}

	function test_user($username, $password) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("SELECT * FROM `users` WHERE `email`='$username' AND `password`='$password'", $connection);
		$rows = mysql_num_rows($query);
		mysql_close($connection);
		if ($rows == 1) {
			return true;
		} else {
			return false;
		}
	}

	function get_user_infos($username) {
		GLOBAL $dbhost;
		GLOBAL $dbuser;
		GLOBAL $dbpass;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($dbhost, $dbuser, $dbpass);
		encoding_fix($connection);
		// Selecting Database
		$db = mysql_select_db("jecc_suivi", $connection);
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$username = mysql_real_escape_string($username);
		// SQL query to fetch information of registerd users and finds user match.
		$query=mysql_query("SELECT `users`.`id`, `users`.`role`, `users`.`uname`, `departements`.`dname`, `users`.`activated` FROM `users`, `departements` WHERE `email`='$username' AND `users`.`departement_id` = `departements`.`id`;", $connection);
		$row = mysql_fetch_assoc($query);
		$rslt = array();
		$rslt['name'] = $row['uname'];
		$rslt['departement'] = $row['dname'];
		$rslt['activated'] = $row['activated'];
		$rslt['id'] = $row['id'];
		$rslt['role'] = $row['role'];
		mysql_close($connection);
		return $rslt;
	}
?>
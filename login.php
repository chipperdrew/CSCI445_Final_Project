<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	PaidSource Login
<?php endblock() ?>

<!-- Attempt to Login -->
<?php
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo 'ERROR: Could not connect to the DB. Aborting...';
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Check if user and pass combo exist
		$users = $db -> query("SELECT user.id, user.first_name, user.last_name, user.username FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "' LIMIT 1;");
		$row = $users->fetch_row();
		if(!empty($row)) {
			$_SESSION[$USER_ID] = $row[0];
			$_SESSION[$USER_FIRST_NAME] = $row[1];
			$_SESSION[$USER_LAST_NAME] = $row[2];
			$_SESSION[$USERNAME] = $row[3];
			echo "<span style='color:green'>You've successfully logged in.</span><br/><strong>get money $ get paid $</strong>";
		} else {
			echo "<span style='color:red'>Either the username does not exist, or the password is incorrect. Please try again.</span>";
		}
	}
?>

<!--
	CSCI445 Final Project
	Authors: Arnie Clark, Andrew Cook, Van Rice
	Team 6
	Due Date: 12/03/13
	TODO:
		- Check the login validity
		- Save request with correct user
		- Add Disqus for commenting
		- Styling
		- Maintain user session
-->
<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Welcome to PaidSource
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>
	<h2>Welcome to PaidSource!</h2>

	<p>Login below:</p>
	<form action="" method="POST">
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" /></td>
			</tr>
		</table>
		<button action="submit">Login</button>
	</form>
<?php endblock() ?>

<?php
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo 'ERROR: Could not connect to the DB. Aborting...';
		exit;
	}


	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Check if user and pass combo exist
		$users = $db -> query("SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'");
		if($users->fetch_row()) {
			echo "Login successful!";
			//session_register($_POST['username']);
			//session_register($_POST['password']);
			//session_start();
		} else {
			echo "<span style='color:red'>Either the username does not exist, or the password is incorrect. Please try again.</span>";
		}
	}
?>




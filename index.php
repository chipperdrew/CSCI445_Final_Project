<!--
	CSCI445 Final Project
	Authors: Arnie Clark, Andrew Cook, Van Rice
	Team 6
	Due Date: 12/03/13
	TODO:
		- User pages
			- My Requests
				- View Submissions
				- Select Submission and/or Close Request
			- My Submissions
		- Styling
-->
<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Welcome to PaidSource
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>
	<h2>Welcome to PaidSource!</h2>
<?php
	if (is_logged_in()) {
		echo "TODO, request listings";
	} else {
		echo '
		<p>Login below:</p>
		<form action="login.php" method="POST">
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
			<button class="btn btn-success" action="submit">Login</button>
		</form>';
	}
?>
<?php endblock() ?>

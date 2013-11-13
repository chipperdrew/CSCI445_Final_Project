<!--
	CSCI445 Final Project
	Authors: Arnie Clark, Andrew Cook, Van Rice
	Team 6
	Due Date: 12/03/13
	TODO:
		- Save registered users to the DB
		- Check the login validity
		- Save requests posts to the DB
		- Add Disqus for commenting
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


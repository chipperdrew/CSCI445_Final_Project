<!--
	CSCI445 Final Project
	Authors: Arnie Clark, Andrew Cook, Van Rice
	Team 6
	Due Date: 12/03/13
	TODO:
		- If user who posted request, have option to close request

		- Styling

		- Show requests on home page??? (Same or different from requests page?)

		- Option to sort requests?
-->
<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Welcome to PaidSource
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>

<?php
	if (is_logged_in()) {
		echo '<div class="well">';
		echo '<div class="page-header">';
		echo "<h2>Welcome to PaidSource!";

		echo "</div>";
		
		} else {
		echo '<div class="well">';
		echo '<div class="page-header">';
		echo "<h2>Welcome to PaidSource!";
		echo "</div>";
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
				
		echo "</div>";
		
		
	}
?>


		<!-- //Brief Overview -->
		<div class="well">
			<h2>Brief Introduction</h2>
			<p>Hello and welcome to <strong>PaidSource. Here you can take advantage of the advanced communication systems
			our time(the internet) to get help with your personal coding projects</p>
			<p>How is this possible? Its quite simple actually. Here at <strong>PaidSource</strong> you can request code packets from other users
			will help you to complete your projects(at a price). Likewise you can complete coding requests made by other users and get paid in the process!</p>
			<p>A suggested first step is for you to finish reading this tutorial and either browse requests made by other users or register as a user and
			join in the fun!</p>
		</div>


		<!-- How to browse requests -->
		<div class ="well">
			<h2>Browsing Requests</h2>
			<p>To start browsing requests you can click the <strong>Code Requests</strong> tab at the top of this page</p>
			<p>Once you have open the Code Requests page you are able to either add your own requests or browse requests
			made by other users this browsing page will show you a list of requests made with the title of the request
			and the name of the users making the request</p>
			<p>To see a description of a specific request simple click on its Title. This will load a new page showing you the request's description
			and possible payout for completing a working solution</p>
			<p>Once you are a user with <strong>PaidSource</strong> you can also submit solutions from this page</p>
		</div>

		
		<!-- //How to add a request -->



		<!-- How to look at your own requests -->
		
		
		
		<!-- When you are finished click the logout button and get money get paid -->


<?php endblock() ?>

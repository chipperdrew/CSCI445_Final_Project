<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Register
<?php endblock() ?>


<?php startblock('content') ?>
	<h3>Fill out the form below to create an account on PaidSource:</h3>
	<form action="" method="POST">
		<table>
			<tr>
				<td>Enter a username:</td>
				<td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<td>Enter a password:</td>
				<td><input type="password" name="password" /></td>
			</tr>
			<tr>
				<td>Verify password:</td>
				<td><input type="password" name="password2" /></td>
			</tr>	
		</table>
		<button action="submit">Register</button>
	</form>
<?php endblock() ?>

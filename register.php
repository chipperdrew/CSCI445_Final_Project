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
				<td>Verify your password:</td>
				<td><input type="password" name="password2" /></td>
			</tr>
			<tr>
				<td>Enter your first name:</td>
				<td><input type="text" name="first" /></td>
			</tr>
			<tr>
				<td>Enter your last name:</td>
				<td><input type="text" name="last" /></td>
			</tr>	
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" /></td>
			</tr>		
		</table>
		<button action="submit">Register</button>
	</form>
<?php endblock() ?>

<?php
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo 'ERROR: Could not connect to the DB. Aborting...';
		exit;
	}


	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$users = $db -> query("SELECT ");

		// Check password matching
		if($_POST['password'] != $_POST['password2']) {
			echo "<span style='color:red'>Your passwords didn't match!</span>";
		} else {
			$users = $db -> query("SELECT * FROM user WHERE username = '" . $_POST['username'] . "'");
			// Check if user already exists
			if($users->fetch_row()) {
				echo "<span style='color:red'>Your username has already been taken, please select a different one.";
			} else {
			// Else enter into DB
				$data = $db -> query("INSERT INTO user (username, password, first_name, last_name, email) VALUES ('$_POST[username]', '$_POST[password]', '$_POST[first]', '$_POST[last]', '$_POST[email]')");
			}
		}
	}
?>


<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Register
<?php endblock() ?>


<?php startblock('content') ?>
	<div class="well">
		<div class="page-header">
			<h3>Fill out the form below to create an account on PaidSource:</h3>
		</div>
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
			<button action="submit" class="btn btn-success">Register</button>
		</form>
	</div>
<?php endblock() ?>

<?php
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo "<span class='red_text'>ERROR: Could not connect to the DB. Aborting...</span>";
		exit;
	}


	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Check if fields are blank
		if(empty($_POST['username']) || empty($_POST['password']) ||
			empty($_POST['first']) || empty($_POST['last']) || empty($_POST['email'])) {
			echo "<span class='red_text'>Please fill out all fields.</span>";
			exit();
		}
		// Check password matching
		if($_POST['password'] != $_POST['password2']) {
			echo "<span class='red_text'>Your passwords didn't match!</span>";
		} else {
		// Query DB
			$users = $db -> query("SELECT * FROM user WHERE username = '" . $_POST['username'] . "'");	
			// Check if user already exists
			if($users->fetch_row()) {
				echo "<span class='red_text'>Your username has already been taken, please select a different one.";
			} else {
			// Else enter into DB
				$data = $db -> query("INSERT INTO user (username, password, first_name, last_name, email) VALUES ('$_POST[username]', '$_POST[password]', '$_POST[first]', '$_POST[last]', '$_POST[email]')");
			}
		}
	}
?>


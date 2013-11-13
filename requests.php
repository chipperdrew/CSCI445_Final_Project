<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Code Requests
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>
	<p>Enter your request:</p>
	<form action="" method="POST">
		<textarea rows="4" cols="40" name="request"></textarea><br/>
		<button type="submit">Request</button>
	</form>
<?php endblock() ?>


<?php
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo 'ERROR: Could not connect to the DB. Aborting...';
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// TODO: Store in DB
			$req = $_POST['request'];
			echo $req;
		}
	}
?>

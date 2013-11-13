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
	// Get and display POST data, if available
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['request']) {
			// TODO: Store request in a DB
			$req = $_POST['request'];
			echo $req;
		}
	}
?>

<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Code Requests
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>
	<p>Enter your request:</p>
	<form action="" method="POST">
		<table>
			<tr>
				<td>Title:</td>
				<td><textarea rows="1" cols="40" name="title"></textarea></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><textarea rows="4" cols="40" name="desc"></textarea></td>
			</tr>
			<tr>
				<td>Minimum Price:</td>
				<td><textarea rows="1" cols="10" name="min_price"></textarea></td>
			</tr>
			<tr>
				<td>Maximum Price:</td>
				<td><textarea rows="1" cols="10" name="max_price"></textarea></td>
			<tr/>
		</table>
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
		$title = $_POST['title'];
		$desc = $_POST['desc'];
		$min_price = $_POST['min_price'];
		$max_price = $_POST['max_price'];

		// TODO Parse price
		// TODO use current user, not default
		$data = $db->query("INSERT INTO request (owner_id, title, description) VALUES (1, '$title', '$desc');");
		// TODO display request details page
		$request_id = $db->insert_id;
		if ($data == true) {
			echo "The request was successfully entered with id $request_id under user with id 1";
		} else {
			echo "Something went wrong with persisting to db.";
		}
	}
?>

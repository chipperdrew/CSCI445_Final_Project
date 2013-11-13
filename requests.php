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

		if (empty($title)) {
			echo "You must enter a title for your request<br/>";
		}

		if (empty($desc)) {
			echo "You must supply a description<br/>";
		}

		if (empty($title) || empty($desc)) {
			exit;
		}

		$replace_needle = array('$', ',');
		$price_pattern_msg = "Prices should be formatted like $1,000.00 or 1000.00<br/>";
		if (!empty($min_price)) {
			$min_price = (float) str_replace($replace_needle, '', $min_price);
			if (empty($min_price) || $min_price < 0) {
				echo "Unknown min price value: $_POST[min_price]<br/>";
				echo $price_pattern_msg;
				exit;
			}
		} else {
			$min_price = 'NULL';
		}

		if (!empty($max_price)) {
			$max_price = (float) str_replace($replace_needle, '', $max_price);
			if (empty($max_price) || $max_price < 0) {
				echo "Unknown max price value: $_POST[max_price]]<br/>";
				echo $price_pattern_msg;
				exit;
			}
		} else {
			$max_price = 'NULL';
		}

		// TODO use current user, not default
		$data = $db->query("INSERT INTO request (owner_id, title, description, price_min, price_max) VALUES (1, '$title', '$desc', $min_price, $max_price);");
		// TODO display request details page
		$request_id = $db->insert_id;
		if ($data == true) {
			echo "The request was successfully entered with id $request_id under user with id 1";
		} else {
			echo "Something went wrong with persisting to db.";
		}
	}
?>

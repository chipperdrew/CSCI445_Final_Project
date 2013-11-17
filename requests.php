<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Code Requests
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>
	<h3>Enter your request:</h3>
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
				<td>Minimum Price (to the nearest dollar):</td>
				<td><textarea rows="1" cols="10" name="min_price"></textarea></td>
			</tr>
			<tr>
				<td>Maximum Price (to the nearest dollar):</td>
				<td><textarea rows="1" cols="10" name="max_price"></textarea></td>
			<tr/>
		</table>
		<button type="submit" class="btn btn-success">Request</button>
	</form>

	<h2>Current Requests Shown Below:</h2>
<?php endblock() ?>


<?php
	// Connect to the DB
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo 'ERROR: Could not connect to the DB. Aborting...';
		exit;
	}

	// Display all requests
	$requests = $db -> query("SELECT * FROM request");
	while($row = $requests->fetch_row()) {
		echo "<a href='post_base.php?id=$row[0]'>" // Link based on request id
			. "<h3>$row[3]</h3></a>"	   // Request Title
			. "Posted by user: ";		   // User_id
		// Get username based off of id
		$user = $db -> query("SELECT username FROM user where id=$row[1]");
		if($username = $user->fetch_row()) {
			echo $username[0];
		}
	}
	echo "<br/>";

	// Check if user is posting a request
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
			echo "<br/>The request was successfully entered with id $request_id under user with id 1";
		} else {
			echo "<br/>Something went wrong with persisting to db.";
		}
	}
?>

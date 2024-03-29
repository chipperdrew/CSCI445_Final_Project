<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Code Requests
<?php endblock() ?>

<!-- Content block -->
<?php startblock('content') ?>
	<div class="well well-sm">
		<h3>Enter your request:</h3>
		<form action="" method="POST" role="form">
				<table>
					<div class="form-group">				
						<tr>
							<td>Title:</td>
							<td><textarea rows="1" cols="40" name="title"></textarea></td>
						</tr>
					</div>
					<div class="form-group">				
					<tr>
						<td>Description:</td>
						<td><textarea rows="4" cols="40" name="desc"></textarea></td>
					</tr>
					</div>
					<div class="form-group">				
					<tr>
						<td>Minimum Price (to the nearest dollar):</td>
						<td><textarea rows="1" cols="10" name="min_price"></textarea></td>
					</tr>
					</div>
					<div class="form-group">				
					<tr>
						<td>Maximum Price (to the nearest dollar):</td>
						<td><textarea rows="1" cols="10" name="max_price"></textarea></td>
					<tr/>
					</div>
				</table>
				<button type="submit" class="btn btn-success">Request</button>
		</form>
	</div>
<?php endblock() ?>

<?php
	// Connect to the DB
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo "<span class='red_text'>ERROR: Could not connect to the DB. Aborting...</span>";
		exit;
	}

	// Check if user is posting a request
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$title = $_POST['title'];
		$desc = $_POST['desc'];
		$min_price = $_POST['min_price'];
		$max_price = $_POST['max_price'];
	
		// If user is not logged in, exit
		if(!is_logged_in()) {
			echo "<span class='red_text'>You must be logged in to post a request.</span><br/>";
		}

		// Check if the title or description are empty. If so, exit
		if (empty($title)) {
			echo "<span class='red_text'>You must enter a title for your request</span><br/>";
		}
		if (empty($desc)) {
			echo "<span class='red_text'>You must supply a description</span><br/>";
		}
		if (empty($title) || empty($desc) || !is_logged_in()) {
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
		// Get user id and add to DB
		$user_id = $_SESSION['user_id'];
		$data = $db->query("INSERT INTO request (owner_id, title, description, price_min, price_max) VALUES ('$user_id', '$title', '$desc', $min_price, $max_price);");
		$request_id = $db->insert_id;
		if ($data == true) {
			echo "<br/>The request was successfully entered!";
		} else {
			echo "<br/><span class='red_text'>Something went wrong with the DB. Please try again.</span>";
		}
	}

	// Display all requests
	$requests = $db -> query("SELECT * FROM request WHERE accepted_submission_id is NULL");
	echo "<div class='well well-sm' id='jankdiv'>";
	echo '<table class="table-striped">';
	echo "<caption><h2>Current Requests</h2></caption>";
	echo "<tr>";
	echo "<th>Title of Request</th>";
	echo "<th>Posted By:</th>";
	echo "</tr>";
	while($row = $requests->fetch_row()) {
		echo "<tr>";
		echo "<td>";
		echo "<a href='post_base.php?id=$row[0]'>" // Link based on request id
			. "<h3>$row[3]</h3></a>";
		echo "</td>";
		// Get username based off of id
		$user = $db -> query("SELECT username FROM user where id=$row[1]");
		if($username = $user->fetch_row()) {
			echo "<td><h3>$username[0]</h3></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "</div>";
?>

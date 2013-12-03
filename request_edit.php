<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Edit Request
<?php endblock() ?>

<!-- Get the content of the post, if it exists -->
<?php
	// Connect to db
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo "<span class='red_text'>ERROR: Could not connect to the DB. Aborting...</span>";
		exit;
	}
	$request_open = false;
	// Get request
	$request = $db -> query("SELECT * FROM request WHERE id= " . $_GET['id']);
	$post_data = $request->fetch_row();
?>

<?php startblock('content') ?>
	<!-- Edit form -->
	<h3>Edit your post</h3>
	<form action="" method="POST">
		<table>
			<tr>
				<td>Title:</td>
				<td><textarea rows="1" cols="40" name="title"><?php echo "$post_data[3]" ?></textarea></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><textarea rows="4" cols="40" name="desc"><?php echo "$post_data[4]" ?></textarea></td>
			</tr>
			<tr>
				<td>Minimum Price (to the nearest dollar):</td>
				<td><textarea rows="1" cols="10" name="min_price"><?php echo "$post_data[5]" ?></textarea></td>
			</tr>
			<tr>
				<td>Maximum Price (to the nearest dollar):</td>
				<td><textarea rows="1" cols="10" name="max_price"><?php echo "$post_data[6]" ?></textarea></td>
			<tr/>
		</table>
		<button type="submit" class="btn btn-success">Update</button>
	</form>
<?php endblock() ?>
	
<?php
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

		// Update the DB and output message
		$data = $db->query("UPDATE request SET title='$title', description='$desc', price_min='$min_price', price_max='$max_price' WHERE id= $_GET[id];");
		if ($data == true) {
			echo "<br/><div class='alert alert-success'>The request was successfully updated!</div>";
		} else {
			echo "<br/><div class='alert alert-failure'>Something went wrong with the DB. Please try again.</div>";
		}
	}
?>  


<?php include 'base.php' ?>


<!-- Title block --> 
<?php startblock('title') ?>
	My Page
<?php endblock('title') ?>


<?php
	echo "<div id='jankdiv'>";

	// Connect to the DB
	$db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
	if(mysqli_connect_errno()) {
		echo "<span class='red_text'>ERROR: Could not connect to the DB. Aborting...</span>";
		exit;
	}

	// Show all open requests by user
	echo "<h3>All open requests by $_SESSION[username]:</h3>";
	$open_reqs = $db->query("SELECT id, title FROM request WHERE accepted_submission_id IS NULL AND owner_id=$_SESSION[user_id]");
	while($row = $open_reqs->fetch_row()) {
		echo "<a href='post_base.php?id=$row[0]'>$row[1]</a><br/>";
	}
	echo "<br/><br/>";

	// Show all closed requests by user
	echo "<h3>All closed requests by $_SESSION[username]:</h3>";
	$open_reqs = $db->query("SELECT id, title FROM request WHERE accepted_submission_id IS NOT NULL AND owner_id=$_SESSION[user_id]");
	while($row = $open_reqs->fetch_row()) {
		echo "<a href='post_base.php?id=$row[0]'>$row[1]</a><br/>";
	}
	echo "<br/><br/>";

	// Show all submission by user
	echo "<h3>All requests for which $_SESSION[username] has a submission:</h3>";
	$open_reqs = $db->query("SELECT request_id FROM submission WHERE user_id=$_SESSION[user_id]");
	while($row = $open_reqs->fetch_row()) {
		$title_query = $db->query("SELECT title FROM request WHERE id=$row[0]");
		$title = $title_query->fetch_row();
		echo "<a href='post_base.php?id=$row[0]'>$title[0]</a><br/>";
	}

	echo "</div>";

	echo "This is a test download link: <br>";
	echo '<a href="download_file.php?id=321">Download Me</a>';
?>


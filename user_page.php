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
	echo '<div class="well">';
	echo "<h3>All open requests by $_SESSION[username]:</h3>";
	$open_reqs = $db->query("SELECT id, title FROM request WHERE accepted_submission_id IS NULL AND owner_id=$_SESSION[user_id]");
	echo "<ul>";
	while($row = $open_reqs->fetch_row()) {
		echo "<li><a href='post_base.php?id=$row[0]'>$row[1]</a></li>";
		// Check for submissions on requests
		$submissions = $db->query("SELECT user.username, submission.file_name, submission.id, request.accepted_submission_id
			FROM request
			INNER JOIN submission ON submission.request_id = request.id
			INNER JOIN user ON user.id = submission.user_id
			WHERE request.id = " . $row[0]);
		echo "<ul>";
		while($sub = $submissions->fetch_row()) {
			$id = $sub[2];
			echo "<li>$sub[0]'s submission: <a class=\"btn btn-primary btn-xs\" href=\"download_file.php?id=$id\">$sub[1] <span class=\"left-pad glyphicon glyphicon-floppy-save\"></span></a>";
			if (!isset($sub[3])) {
				echo "<a class=\"left-pad btn btn-success btn-xs\" href=\"accept_submission.php?id=$id\">Accept Submission<span class=\"left-pad glyphicon glyphicon-ok\"></span></a></li>";
			}
		}
		echo "</ul>";
	}
	echo "</ul><br/>";
	echo '</div>';
	echo '<div class="well">';
	// Show all closed requests by user
	echo "<h3>All closed requests by $_SESSION[username]:</h3>";
	$open_reqs = $db->query("SELECT id, title FROM request WHERE accepted_submission_id IS NOT NULL AND owner_id=$_SESSION[user_id]");
	while($row = $open_reqs->fetch_row()) {
		echo "<a href='post_base.php?id=$row[0]'>$row[1]</a><br/>";
	}
	echo "<br/><br/>";
	echo "</div>";
	
	// Show all submission by user
	echo '<div class="well">';
	
	echo "<h3>All requests for which $_SESSION[username] has a submission:</h3>";
	$open_reqs = $db->query("SELECT request_id FROM submission WHERE user_id=$_SESSION[user_id]");
	while($row = $open_reqs->fetch_row()) {
		$title_query = $db->query("SELECT title FROM request WHERE id=$row[0]");
		$title = $title_query->fetch_row();
		echo "<a href='post_base.php?id=$row[0]'>$title[0]</a><br/>";
	}
	echo "</div>"
	echo "</div>";
?>


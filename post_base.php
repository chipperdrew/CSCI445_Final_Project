<?php include "base.php" ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Post View
<?php endblock() ?>

<?php startblock('content') ?>
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
		if($post_data = $request->fetch_row()) {
			echo "<h2>$post_data[3]</h2>"	 	// Title
			. "<h4>$post_data[4]</h4>"		// Description
			. "<p>Username: ";
			// Get the username based on user id
			$user = $db -> query("SELECT username FROM user where id=$post_data[1]");
			if($username = $user->fetch_row()) {
				echo "$username[0]<br/>";
			}	
			echo "Minimum payout: $$post_data[5]</br>"	// Min price
			. "Maximum payout: $$post_data[6]<br/>";	// Max price
			// Check if an answer has been selected
			if($post_data[2]) {
				echo "The post is <span style='color:red; font-weight:bold'>CLOSED</span>
			 		for submissions";
			} else {
				echo "The post is <span style='color:green; font-weight:bold'>OPEN</span> 
					for submissions";
				$request_open = true;
			}
		
			// Check if the user owns the post
			if($post_data[1]==$_SESSION['user_id']) {
				echo "<br/><a href='request_edit.php?id=$_GET[id]'>Edit your post</a>";
			}
		}
		if ($request_open) {
			$id = $_GET['id'];
			echo "
			<div class=\"panel panel-info fifty\">
				<!-- File Upload -->
				<div class=\"panel-heading\"><h3 class=\"panel-title\">Submit Code</h3></div>
				<div class=\"panel-body\">
					<form action=\"submission_upload.php?id=$id\" method=\"post\" enctype=\"multipart/form-data\">
						<label for=\"file\">Filename:</label>
						<input type=\"file\" name=\"file\" id=\"file\"><br>
						<input onclick=\"return verifyFile();\" type=\"submit\" name=\"submit\" value=\"Submit\">
					</form>
				</div>
			</div>";
		}
	?>

	<!-- Intense Debate comments -->
<script>
var idcomments_acct = '649f0b4f2fdb55816123cade693b12fb';
var idcomments_post_id;
var idcomments_post_url;
</script>
<span id="IDCommentsPostTitle" style="display:none"></span>
<script type='text/javascript' src='http://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>
<script>
	function verifyFile() {
		var f = document.getElementById("file");
		if (!(f && f.value)) {
			alert("You must select a file for upload");
			return false;
		}
		return true;
	}
</script>
<?php endblock() ?>


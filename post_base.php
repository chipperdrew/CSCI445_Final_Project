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
			echo 'ERROR: Could not connect to the DB. Aborting...';
			exit;
		}
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
			}	
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


<?php endblock() ?>	

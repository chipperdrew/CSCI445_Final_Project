<?php require_once 'ti.php'; 
	session_start(); // every page maintains a session, login verification needs to be made on a per page basis
	// create and store session vars in $_SESSION['blah']
	$USER_ID = 'user_id';
	$USERNAME = 'username';
	$USER_FIRST_NAME = 'user_first_name';
	$USER_LAST_NAME = 'user_last_name';
?> 
<html> 
<head> 
	<title> 
		<?php emptyblock('title') ?> 
	</title>
 
	<link href="css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>


	
<body>
	<div id='navBar'>
		<?php startblock('navBar') ?>
			<a href="index.php">Home</a>
			<a href="requests.php">Code Requests</a>
			<a href="register.php">Register</a>
			<?php
				if (isset($_SESSION[$USER_ID])) {
					echo '<a href="logout.php">Logout</a>';
				}
			?>
			<br/>
		<?php endblock() ?>
	</div>

	<div id='content'> 
		<?php startblock('content') ?> 
		<?php endblock() ?> 
	</div> 
</body> 
</html>

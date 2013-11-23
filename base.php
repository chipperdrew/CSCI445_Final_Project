<?php require_once 'ti.php'; 
	session_start(); // every page maintains a session, login verification needs to be made on a per page basis
	// create and store session vars in $_SESSION['blah']
	define('USER_ID', 'user_id');
	define('USERNAME', 'username');
	define('USER_FIRST_NAME', 'user_first_name');
	define('USER_LAST_NAME', 'user_last_name');
	function is_logged_in() {
		if (isset($_SESSION[USER_ID])) {
			return true;
		}
		return false;
	}
?> 
<html> 
<head> 
	<title> 
		<?php emptyblock('title') ?> 
	</title>
 
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="our.css" rel="stylesheet">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>


	
<body>
	<div id="jankdiv">
		<div id='navBar'>
			<?php startblock('navBar') ?>
			
				<ul class="nav nav-tabs">
					<li><a href="index.php">Home</a></li>
					<li><a href="requests.php">Code Requests</a></li>
					<?php
						if (is_logged_in()) {
							echo '<li><a href="logout.php">Logout</a></li>';
						} else {
							echo '<li><a href="register.php">Register</a></li>';
						}
					?>
				<ul>
				<br/>
			<?php endblock() ?>
		</div>

		<div id='content'> 
			<?php startblock('content') ?> 
			<?php endblock() ?> 
		</div>
	</div>	
</body> 
</html>

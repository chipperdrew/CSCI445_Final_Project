<?php require_once 'ti.php'
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
			<br/>
		<?php endblock() ?>
	</div>

	<div id='content'> 
		<?php startblock('content') ?> 
		<?php endblock() ?> 
	</div> 
</body> 
</html>

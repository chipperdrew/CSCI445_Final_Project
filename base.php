<?php require_once 'ti.php'; 
  session_start(); // every page maintains a session, login verification needs to be made on a per page basis
  // create and store session vars in $_SESSION['blah']
?> 
<html> 
<head> 
	<title> 
		<?php emptyblock('title') ?> 
	</title> 
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

<?php require_once 'ti.php' ?> 
<html> 
<head> 
	<title> 
		<link href="css/bootstrap.css" rel="stylesheet">
		<script type="text/javasript" src="js/bootstrap.js">
		
		
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

<?php require_once 'ti.php' ?> 
<html> 
<head> 
	<title> 
		<?php emptyblock('title') ?> 
	</title>
 
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>


	
<body>
	<div id='navBar'>
		<?php startblock('navBar') ?>
		
			<ul class="nav nav-tabs">
				<li><a href="index.php">Home</a></li>
				<li><a href="requests.php">Code Requests</a></li>
				<li><a href="register.php">Register</a></li>
			<ul>
			<br/>
	

		<?php endblock() ?>
	</div>

	<div id='content'> 
		<?php startblock('content') ?> 
		<?php endblock() ?> 
	</div> 
</body> 
</html>

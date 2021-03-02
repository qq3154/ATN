<html>
	<head>
		<title>Home Page</title>
		<title>Bootstrap Example</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">ATN</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					
					<li><a href="HN.php">Hanoi store</a></li>
					<li><a href="DN.php">Danang store</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="changepassword.php"><span class="glyphicon glyphicon-user"></span> Change Password</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				</ul>
			 </div>
		</nav>
		<?php 			
			session_start();
			if($_SESSION["valid"] != true){
				header("location: login.php");
			}
		?>	
		<h2>&nbsp;&nbsp;Welcome to ATN website</h2> 
		<p>&nbsp;&nbsp;ATN is a Vietnamese company which is selling toys to teenagers in many provinces all over Vietnam. The company has the revenue over 500.000 dollars/year. </p>
		
	</body>
</html>

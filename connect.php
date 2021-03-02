<?php
	session_start();
	# Heroku credential 
	$host_heroku = "ec2-34-203-255-149.compute-1.amazonaws.com";
	$db_heroku = "dfafdda85iuufp";
	$user_heroku = "fwhvqbdasvcpdw";
	$pw_heroku = "ee454b013d21e0981d72f13efd5297cb5392457328d856308fe8bd8b23ac168a";
			
	# Create connection to Heroku Postgres
	$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
			
	$pg_heroku = pg_connect($conn_string);
	$_SESSION["pg_heroku"] = pg_connect($conn_string);		
	if (!$pg_heroku)
	{
		die('Error: Could not connect: ' . pg_last_error());
	}
	

	$username = $_POST['user'];
	$password = $_POST['pass'];
	$query = "select * from users where username ='$username' AND password = '$password' ";
	$result = pg_query($pg_heroku, $query);
	if(pg_num_rows($result) == 1){
		$row = pg_fetch_assoc($result);
		$_SESSION["username"] = $row['username'];
		$_SESSION["role"] = $row['role'];
		$_SESSION["valid"] = true;
		echo "Login successful!!!";
		header( "refresh:1;url=index.php" );
	}
	else {
		echo "Username or Password is wrong. ";
		echo "Please try again!!!";
		header( "refresh:2;url=login.php" );
	}	
	
?>
		

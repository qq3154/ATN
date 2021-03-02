<?php
	session_start();
	# Heroku credential 
	$host_heroku = "ec2-18-211-97-89.compute-1.amazonaws.com";
	$db_heroku = "dfve3f805q22f9";
	$user_heroku = "kmgztgdbtyyfmc";
	$pw_heroku = "f7f03ff05c4eed2ecb9a822f79445b0b818f97aa8d156610ae811d46265ca0a2";
			
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
		

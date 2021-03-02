<html>
	<?php
		session_start();
		$host_heroku = "ec2-34-203-255-149.compute-1.amazonaws.com";
		$db_heroku = "dfafdda85iuufp";
		$user_heroku = "fwhvqbdasvcpdw";
		$pw_heroku = "ee454b013d21e0981d72f13efd5297cb5392457328d856308fe8bd8b23ac168a";
			
		# Create connection to Heroku Postgres
		$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
			
		$pg_heroku = pg_connect($conn_string);

		$query = "select * from danang where product_name ='car_toy' ";
		$result = pg_query($pg_heroku, $query);
		
		$name = $_POST['name'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];	
		$role =  $_SESSION["role"];
		if($role == 2) $table = "hanoi";
		if($role == 3) $table = "danang";
		$query = "INSERT INTO $table values (DEFAULT,'$name',$price,$quantity)";
		pg_query($pg_heroku, $query);
		$message = "Add successful!!!";				
		echo "<script type='text/javascript'>alert('$message');</script>";
		if($role == 2) header( "refresh:0;url=HN.php" );
		if($role == 3) header( "refresh:0;url=DN.php" );
	?>
</html>	
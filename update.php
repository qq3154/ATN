<html>
	<?php
		session_start();
		$host_heroku = "ec2-18-211-97-89.compute-1.amazonaws.com";
		$db_heroku = "dfve3f805q22f9";
		$user_heroku = "kmgztgdbtyyfmc";
		$pw_heroku = "f7f03ff05c4eed2ecb9a822f79445b0b818f97aa8d156610ae811d46265ca0a2";
			
		# Create connection to Heroku Postgres
		$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
			
		$pg_heroku = pg_connect($conn_string);
		$name = $_POST['name'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];	
		$role =  $_SESSION["role"];
		if($role == 2) $table = "hanoi";
		if($role == 3) $table = "danang";
		$query = "select * from danang where product_name ='$name' ";
		$result = pg_query($pg_heroku, $query);
		$row = pg_fetch_array($result);
		if ($_POST["name"] == $row["product_name"]) {		
			$query = "UPDATE $table set product_price = $price, quantity = $quantity where product_name = '$name' ";
			pg_query($pg_heroku, $query);				
			$message = "Update successful!!!";				
			echo "<script type='text/javascript'>alert('$message');</script>";
			if($role == 2) header( "refresh:0;url=HN.php" );
			if($role == 3) header( "refresh:0;url=DN.php" );	 		
		} 
		else{
			echo "Can't find item $name ...";
			if($role == 2) header( "refresh:2;url=HN.php" );
			if($role == 3) header( "refresh:2;url=DN.php" );	
		}
	?>
</html>	
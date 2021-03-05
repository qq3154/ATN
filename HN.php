<html>
	<head>
		<title>PHP Test</title>
		<title>Bootstrap Example</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<style>
			.myDIV {
				width: 80%;
				margin: auto;
				padding: 20px;
				text-align: center;
				background-color: lightblue;
				margin-top: 20px
				margin-bottom: 40px;
				border: 5px solid black;
			}	
			.mainmenu{
				width: 80%;
				margin: auto;
				background-color: beige;
			}
			h3{
				padding-left:50px;
				margin: 0;
				display: inline-block;
			}
		</style>
		
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">ATN</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>					
					<li class="active"><a href="#">Hanoi store</a></li>
					<li><a href="DN.php">Danang store</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="changepassword.php"><span class="glyphicon glyphicon-user"></span> Change Password</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				</ul>
			 </div>
		</nav>
		<br><br>
		<?php 			
			session_start();
			if($_SESSION["role"] == 3) {
				
				$message = "You are not allow to access this page! Return to main page";				
				echo "<script type='text/javascript'>alert('$message');</script>";
				header( "refresh:0;url=index.php" );
			}
			else {
				
						
				# Heroku credential 
				$host_heroku = "ec2-18-211-97-89.compute-1.amazonaws.com";
				$db_heroku = "dfve3f805q22f9";
				$user_heroku = "kmgztgdbtyyfmc";
				$pw_heroku = "f7f03ff05c4eed2ecb9a822f79445b0b818f97aa8d156610ae811d46265ca0a2";
			
				# Create connection to Heroku Postgres
				$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
				
				$pg_heroku = pg_connect($conn_string);
				$role =  $_SESSION["role"];
			}					
		?> 
		<div class="mainmenu" >
			<div>
				<br><br>
			</div>
			<ion-list >
				<ion-item>
					<h3 >Show products information </h3>
					<button  onclick="myFunction(1)">Show</button>              
				</ion-item>
			</ion-list>
			<div class="myDIV" id="myDIV1" style = "display:none">
				<?php
					# Get data by query
					$query = 'select * from hanoi';
					$result = pg_query($pg_heroku, $query);
					# Display data column by column
					$i = 0;
					echo '<html><body><table><tr>';
					while ($i < pg_num_fields($result))
					{
						$fieldName = pg_field_name($result, $i);
						echo '<td>' . $fieldName . '</td>';
						$i = $i + 1;
					}
					echo '</tr>';
					# Display data row by row
					$i = 0;
					while ($row = pg_fetch_row($result)) 
					{
						echo '<tr>';
						$count = count($row);
						$y = 0;
						while ($y < $count)
						{
							$c_row = current($row);
							echo '<td>' . $c_row . '</td>';
							next($row);
							$y = $y + 1;
						}
						echo '</tr>';
						$i = $i + 1;
					}
					pg_free_result($result);

					echo '</table></body></html>';
				?>		
			</div>				
			<div>
				<br><br>
			</div>

			<ion-list>
				<ion-item>
					<h3>Update products</h3>
					<button <?php if($role == 1) {?> disabled="disabled" <?php } ?> onclick="myFunction(2)">Update</button>              
				</ion-item>
			</ion-list>
			<div class="myDIV" id="myDIV2" style = "display:none">
				<form action="update.php" method="post" > 
  					<p>
						<label>Product name: &nbsp; &nbsp;&nbsp;</label>
						<input type="text" placeholder="Enter name" id="name" name="name"/>
					</p>
			
					<p>
						<label>Product price: &nbsp;&nbsp;&nbsp;&nbsp; </label>
						<input type="text" placeholder="Enter price" id="price" name="price"/>
					</p>
                
					<p>
						<label>Product quantity:</label>
						<input type="text" placeholder="Enter quantity" id="quantity" name="quantity"/>
					</p>
			
					<p>
						<input type="submit" id="btn" value="Submit" />
					</p>	
				</form>  					
			</div>
			<div>
				<br><br>
			</div>

			<ion-list>
				<ion-item>
					<h3>Add products</h3>
					<button <?php if($role == 1) {?> disabled="disabled" <?php } ?> onclick="myFunction(3)">Add</button>              
				</ion-item>
			</ion-list>
			<div class="myDIV" id="myDIV3" style = "display:none">
				<form action="add.php" method="post" > 
  					<p>
						<label>Product name: &nbsp; &nbsp;&nbsp;</label>
						<input type="text" placeholder="Enter name" id="name" name="name"/>
					</p>
			
					<p>
						<label>Product price: &nbsp;&nbsp;&nbsp;&nbsp; </label>
						<input type="text" placeholder="Enter price" id="price" name="price"/>
					</p>
                
					<p>
						<label>Product quantity:</label>
						<input type="text" placeholder="Enter quantity" id="quantity" name="quantity"/>
					</p>
			
					<p>
						<input type="submit" id="btn" value="Submit" />
					</p>	
				</form>  					
			</div>
			<div>
				<br><br>
			</div>

			<ion-list>
				<ion-item>
					<h3>Delete products</h3>
					<button <?php if($role == 1) {?> disabled="disabled" <?php } ?> onclick="myFunction(4)">Delete</button>              
				</ion-item>
			</ion-list>
			<div class="myDIV" id="myDIV4" style = "display:none">
				<form action="delete.php" method="post" > 
  					<p>
						<label>Product name: &nbsp; &nbsp;&nbsp;</label>
						<input type="text" placeholder="Enter name" id="name" name="name"/>
					</p>
			
					<p>
						<input type="submit" id="btn" value="Submit" />
					</p>	
				</form>  					
			</div>
			<div>
				<br><br>
			</div>
		</div>

		
		<script>
			function myFunction(i) {
				if(i==1)
					var x = document.getElementById("myDIV1");
				if(i==2)
					var x = document.getElementById("myDIV2");
				if(i==3)
					var x = document.getElementById("myDIV3");
				if(i==4)
					var x = document.getElementById("myDIV4");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
		</script>
	</body>
</html>

<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" types"text/css" href="css/login.css"/>
</head>
<body>
	<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
		<div style="width:500px;">
			<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
			<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
				<tr class="tableheader">
					<td colspan="2">Change Password</td>
				</tr>
				<tr>
					<td width="40%"><label>Current Password</label></td>
					<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
				</tr>
				<tr>
					<td><label>New Password</label></td>
					<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
				</tr>
				<td><label>Confirm Password</label></td>
					<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
<script>
	function validatePassword() {
	var currentPassword,newPassword,confirmPassword,output = true;

	currentPassword = document.frmChange.currentPassword;
	newPassword = document.frmChange.newPassword;
	confirmPassword = document.frmChange.confirmPassword;

	if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
	}
	else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
	}
	else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
	}
	if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
	} 	
	return output;
	}
</script>

<?php
	session_start();

	$host_heroku = "ec2-34-203-255-149.compute-1.amazonaws.com";
	$db_heroku = "dfafdda85iuufp";
	$user_heroku = "fwhvqbdasvcpdw";
	$pw_heroku = "ee454b013d21e0981d72f13efd5297cb5392457328d856308fe8bd8b23ac168a";
			
	# Create connection to Heroku Postgres
	$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
			
	$pg_heroku = pg_connect($conn_string);
	
	
	if(count($_POST) > 0){
		$username = $_SESSION["username"];
		$query = "select * from users where username ='$username' ";
		$result = pg_query($pg_heroku, $query);
		$row = pg_fetch_array($result);
		if ($_POST["currentPassword"] == $row["password"]) {
			$newpwd = $_POST["newPassword"];
			$query = "UPDATE users set password = '$newpwd' where username = '$username' ";
			pg_query($pg_heroku, $query);
			$message = "Change password successful!!!";				
			echo "<script type='text/javascript'>alert('$message');</script>";
			header( "refresh:0;url=index.php" );
			
		} 
		else
			echo "Current Password is not correct";
	}
	
?>
<?php
session_start();
include('database.php');
if(isset($_POST['submit'])){
	$email=mysqli_real_escape_string($cn, $_POST['email']);
	$password1=mysqli_real_escape_string($cn, $_POST['password']);
	$password=md5($password1);

	$query="SELECT * FROM log WHERE email='$email' AND password='$password';";
	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

	if(!mysqli_num_rows($rs)){
		echo "Invalid Username or Password";
	}
	else{
		header('Location: dashboard.php');
		$_SESSION['login']=1;
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

<script type="text/javascript">
	function validation(){
		var email=document.forms["login"]["email"].value;
		var password=document.forms["login"]["password"].value;
		var x = document.getElementById("myEmail").pattern;

		if(email==""){
			alert("Enter your Email.");
			return false;
		}

		if(password==""){
			alert("Enter your password.");
			return false;
		}
		
	}
</script>

</head>
<body>

<form method="POST" name="login" onsubmit="return validation()">
	<table>
		<tr>
			<td>Email:</td>
			<td><input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password"></td>
		</tr>

		<tr>
			<td><input type="submit" name="submit"></td>
		</tr>
	</table>
</form>

<a href="forgotpassword.php"> <button>Forgot Password</button> </a>

</body>
</html>
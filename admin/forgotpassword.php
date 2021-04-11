<?php
include('database.php');
	if(isset($_POST['submit'])){
		$email=mysqli_real_escape_string($cn, $_POST['email']);

		$query="SELECT id, password from log where email='$email';";
		$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
		if(mysqli_num_rows($rs)){
			$row=mysqli_fetch_array($rs);
			$id=$row['id'];
			$password=$row['password'];

			$to_email = $email;
			$subject = "Password Reset";
			$body = "Your password is ".$password;
			$headers = "From: haudemanxae@gmail.com";
			 
			if (mail($to_email, $subject, $body, $headers)) {
			    echo "Email successfully sent to $to_email...";
			} else {
			    echo "Email sending failed...";
			}

		}
		else
		{
			echo "No email address found";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>
<form method="POST">	
	<table>
		<tr>
			<td><a href="index.php">HOME</a> </td>	
		</tr>

		<tr>
			<td>Enter your E-mail:</td>
			<td><input type="email" name="email"></td>
		</tr>

		<tr><td><input type="submit" name="submit"></td></tr>
	</table>
</body>
</form>
</html>
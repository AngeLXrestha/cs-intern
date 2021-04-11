<?php 
include('includes/header.php');
//fetch the data from log for changing password
$query="SELECT * FROM log";
$rs=mysqli_query($cn, $query) or die(mysqli_query($cn));
$row=mysqli_fetch_array($rs);
$databasePassword=$row['password'];
$id=$row['id'];

if(isset($_POST['submit'])){
	$oldPassword0=mysqli_real_escape_string($cn, $_POST['oldPassword']);
	$newPassword0=mysqli_real_escape_string($cn, $_POST['newPassword']);
	$confirmPassword0=mysqli_real_escape_string($cn, $_POST['confirmPassword']);

	$oldPassword=md5($oldPassword0);
	$newPassword=md5($newPassword0);
	$confirmPassword=md5($confirmPassword0);

	//check whether the new password matches the password from database or not
	if($oldPassword==$databasePassword){

		//check whether the new password and confirm password matches or not
		if($newPassword==$confirmPassword){
			$query1="UPDATE `log` SET `password` = '$newPassword' WHERE `log`.`id` = '$id';";
			$rs1=mysqli_query($cn, $query1) or die(mysqli_error($cn));
			echo "Password changed";
		}
		else{

			echo "New Password and Confirm Password does not match";
		}
	}
	else{
		echo "Password does not match, please enter your correct password";
	}

}
?>
<form method="POST">
	<table>
		<tr>
			<td>Email:</td>
			<td><?php echo $row['email']?></td>
		</tr>

		<tr>
			<td>Old Password:</td>
			<td><input type="password" name="oldPassword"></td>
		</tr>

		<tr>
			<td>New Password</td>
			<td><input type="password" name="newPassword"></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" name="confirmPassword"></td>
		</tr>

		<tr>
			<td><input type="submit" name="submit"></td>
		</tr>
	</table>
</form>
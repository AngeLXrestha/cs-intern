<?php
include('includes/header.php');

	$query="SELECT * FROM g_settings";
	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
	//only fetching if thier is data in the g_settings
	if(mysqli_num_rows($rs)!=0){
	$row=mysqli_fetch_array($rs) or die(mysqli_error($cn));
	$id=$row['id'];
	}

	if(isset($_POST['submit'])){

		//id from the g settings
		$siteTitle=mysqli_real_escape_string($cn, $_POST['siteTitle']);
		$facebook=mysqli_real_escape_string($cn, $_POST['facebook']);
		$twitter=mysqli_real_escape_string($cn, $_POST['twitter']);
		$address=mysqli_real_escape_string($cn, $_POST['address']);
		$email=mysqli_real_escape_string($cn, $_POST['email']);
		$number=mysqli_real_escape_string($cn, $_POST['number']);
		$logo=mysqli_real_escape_string($cn, $_POST['logo']);
		$footerContent=mysqli_real_escape_string($cn, $_POST['footerContent']);


			if(mysqli_num_rows($rs)==0){
				echo "Insert data";
				$query3="INSERT INTO `g_settings` 
				(`id`, 
				`siteTitle`, 
				`facebook`, 
				`twitter`,
				`address`, 
				`email`, 
				`number`, 
				`logo`, 
				`footerContent`) 
				VALUES 
				(NULL, 
				'$siteTitle', 
				'$facebook', 
				'$twitter', 
				'$address', 
				'$email', 
				'$number', 
				'$logo', 
				'$footerContent');";
				$rs3=mysqli_query($cn, $query3) or die(mysqli_error($cn));

			}
			else{
			//updating general setting if it consists data	
			$query2="UPDATE `g_settings` 
			SET 
			`siteTitle` = '$siteTitle', 
			`facebook` = '$facebook', 
			`twitter` = '$twitter', 
			`address` = '$address', 
			`email` = '$email', 
			`number` = '$number', 
			`logo` = '$logo', 
			`footerContent` = '$footerContent' 
			WHERE 
			`g_settings`.`id` = '$id';";

			$rs2=mysqli_query($cn, $query2) or die(mysqli_error($cn));
			}
	}
	

?>
<script type="text/javascript">
	function refresh(){

	}
</script>
<form method="POST">
<table>
	<tr>
		<td>Site Title</td>
		<td><input type="text" name="siteTitle" value="<?php if(isset($row['siteTitle'])){ echo $row['siteTitle'];}?>"></td>
	</tr>

	<tr>
		<td>Facebook</td>
		<td><input type="text" name="facebook" value="<?php if(isset($row['facebook'])){ echo $row['facebook'];}?>"></td>
	</tr>

	<tr>
		<td>Twitter</td>
		<td><input type="text" name="twitter" value="<?php if(isset($row['twitter'])){ echo $row['twitter'];}?>"></td>
	</tr>

	<tr>
		<td>Address</td>
		<td><input type="text" name="address" value="<?php if(isset($row['address'])){ echo $row['address'];}?>"></td>
	</tr>

	<tr>
		<td>E-mail</td>
		<td><input type="text" name="email" value="<?php if(isset($row['email'])){echo $row['email'];}?>"></td>
	</tr>

	<tr>
		<td>Number</td>
		<td><input type="text" name="number" value="<?php if(isset($row['number'])){echo $row['number'];}?>"></td>
	</tr>

	<tr>
		<td>Logo</td>
		<td>
			<label for="logo"></label>
			<select name="logo" id="logo">
			<option value="" selected disabled hidden>Select Logo</option>
			<?php
				$query1="SELECT titleName FROM photo";
				$rs1=mysqli_query($cn, $query1);
				while($row1=mysqli_fetch_array($rs1)){
			?>
					<option value="<?php echo $row1['titleName']?>" <?php if($row['logo']==$row1['titleName']){echo 'selected';}?>><?php echo $row1['titleName']?></option>	
			<?php } ?>		
		</select></td>
	</tr>
		<td>Footer Content</td>
		<td><textarea class="summernote" name="footerContent"><?php if(isset($row['footerContent'])){echo $row['footerContent'];}?></textarea></td>
		<td></td>
		<td></td>
	</tr>
</table>
<input type="submit" name="submit" value="submit" onclick="location.reload();">
</form>

<?php
include('includes/footer.php');
?>

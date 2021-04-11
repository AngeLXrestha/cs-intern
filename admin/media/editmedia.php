<?php
include('../database.php');

//fetching id of photo table from get
$p_id=$_GET['id'];
$year=date('Y');
$month=date('m');
$day=date('d');


$query1="SELECT * FROM photo WHERE id=$p_id";
$rs1=mysqli_query($cn, $query1) or die(mysqli_error($cn));
$row1=mysqli_fetch_array($rs1);

if(isset($_POST['submit'])){
	$titleName=mysqli_real_escape_string($cn, $_POST['titleName']);
	echo $titleName;

$query="UPDATE `photo` SET `titleName` = '$titleName' WHERE `photo`.`id` = $p_id";
$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

header("Location: displaymedia.php?msg=update");
}
?>
<form method="POST">
<table>
	<tr>
		<td>Title of the image:</td>
		<td><input type="text" name="titleName" value="<?php echo $row1['titleName'];?>"></td>
	</tr>

	<tr>
		<td>Image</td>
		<td colspan="2"><img src="images/<?php echo $year.'/'.$month.'/'.$day.'/'.$row1['fileName']?>"></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="UPDATE"></td>
	</tr>
</table>
</form>
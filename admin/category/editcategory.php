<?php 
include('../includes/header.php');

if(isset($_GET)){
$id=mysqli_real_escape_string($cn, $_GET['id']);
}

$query="SELECT categoryName from blog_category WHERE id='$id';";
$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
$row=mysqli_fetch_array($rs);

if(isset($_POST['submit'])){
	$currentDate=date('Y-m-d h:i:s');
	$categoryName=mysqli_real_escape_string($cn, $_POST['categoryName']);

	//removing special characters from categoryName form slug with '-'
	$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $categoryName);
	$categorySlug = trim(preg_replace('/\-+/', '-', $slug1));

	$query="UPDATE `blog_category` 
	SET 
	`categoryName` = '$categoryName', 
	`updateDate` = '$currentDate' 
	WHERE `blog_category`.`id` = '$id';";
	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

	header("Location: category.php?msg=update");
}
?>

<form method="POST">
	<table>
		<tr>
			<td>Category Name</td>
			<td><input type="text" name="categoryName" value="<?php echo $row['categoryName']?>"></td>
		</tr>

		<tr>
			<td rowspan="2"><input type="submit" name="submit" value="create"></td>
		</tr>
	</table>
</form>

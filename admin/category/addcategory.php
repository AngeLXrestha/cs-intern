<?php
include('../includes/header.php');

if(isset($_POST['submit'])){
	$categoryName=mysqli_real_escape_string($cn, $_POST['categoryName']);

	//removing special characters from categoryName form slug with '-'
	$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $categoryName);
	$categorySlug = trim(preg_replace('/\-+/', '-', $slug1));

	$query="INSERT INTO `blog_category` 
	(`id`, 
	`categoryName`, 
	`categorySlug`) 
	VALUES 
	(NULL, 
	'$categoryName', 
	'$categorySlug')";
	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

	header("Location: category.php?msg=add");
}
?>

<form method="POST">
	<table>
		<tr>
			<td>Category Name</td>
			<td><input type="text" name="categoryName"></td>
		</tr>

		<tr>
			<td rowspan="2"><input type="submit" name="submit" value="create"></td>
		</tr>
	</table>
</form>

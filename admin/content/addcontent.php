<?php
include('../includes/header.php');
if(isset($_POST['submit'])){
	$categoryName = '';
	$image = '';
	$currentDate=date('Y-m-d h:i:s');

	if(isset($_POST['category'])){
		$categoryName = mysqli_real_escape_string($cn, $_POST['category']);

		//fetching category id to store in the content table
		$query2 = "SELECT id FROM blog_category WHERE `categoryName` = '$categoryName';";
		$rs2 = mysqli_query($cn, $query2) or die(mysqli_error($cn));
		$row2=mysqli_fetch_array($rs2);
		$categoryID=$row2['id'];
	}

	if(isset($_POST['image'])){
		$image = mysqli_real_escape_string($cn, $_POST['image']);
	}
	$contentTitleName = mysqli_real_escape_string($cn, $_POST['contentTitleName']);


	$contentDescription = mysqli_real_escape_string($cn, $_POST['contentDescription']);
	$content = mysqli_real_escape_string($cn, $_POST['content']);
	$contentMetaTitle = mysqli_real_escape_string($cn, $_POST['contentMetaTitle']);
	$contentMetaKeyword = mysqli_real_escape_string($cn, $_POST['contentMetaKeyword']);
	$contentMetaDescription = mysqli_real_escape_string($cn, $_POST['contentMetaDescription']);

	
	//for content title slug
	$query1 = "SELECT contentTitleName from content WHERE contentTitleName='$contentTitleName';";
	$rs1 = mysqli_query($cn, $query1) or die(mysqli_error($cn));
	if(mysqli_num_rows($rs1)){
		$count = mysqli_num_rows($rs1);
		$contentTitleName1 = $contentTitleName . ($count + 1);

		//removing special characters from contentTitleName form slug with '-'
		$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $contentTitleName1);
		$contentTitleSlug = trim(preg_replace('/\-+/', '-', $slug1));
	}
	else{
		//removing special characters from contentTitleName form slug with '-'
		$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $contentTitleName);
		$contentTitleSlug = trim(preg_replace('/\-+/', '-', $slug1));
	}

	$query3="INSERT INTO `content` 
	(`id`, 
	`contentTitleName`, 
	`contentTitleSlug`, 
	`category_id`, 
	`categoryName`, 
	`image`, 
	`contentInsertDate`, 
	`contentUpdateDate`, 
	`contentDescription`, 
	`contentMetaTitle`, 
	`contentMetaKeyword`, 
	`contentMetaDescription`, 
	`content`) 
	VALUES 
	(NULL, 
	'$contentTitleName', 
	'$contentTitleSlug', 
	'$categoryID', 
	'$categoryName', 
	'$image', 
	'$currentDate', 
	'$currentDate', 
	'$contentDescription', 
	'$contentMetaTitle', 
	'$contentMetaKeyword', 
	'$contentMetaDescription', 
	'$content');";
	$rs3=mysqli_query($cn, $query3) or die(mysqli_error($cn));

}
?>
<form method="POST">
	<table>
		<tr>
			<td>Content Title</td>
			<td><input type="text" name="contentTitleName"></td>
		</tr>

		<tr>
			<td>Category</td>
			<td>
				<select name="category">
					<option value="" selected disabled hidden>Choose category</option>
				<?php
					$query="SELECT categoryName from blog_category";
					$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
					while($row=mysqli_fetch_array($rs)){
				?>
					<option value="<?php echo $row['categoryName']?>"><?php echo $row['categoryName']?></option>
				<?php } ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Image</td>
			<td>
				<select name="image">
					<option value="" selected disabled hidden>Choose image</option>
				<?php
					$query1="SELECT titleName from photo";
					$rs1=mysqli_query($cn, $query1) or die(mysqli_error($cn));
					while($row1=mysqli_fetch_array($rs1)){
				?>
					<option value="<?php echo $row1['titleName']?>"><?php echo $row1['titleName']?></option>
				<?php } ?>
				</select>
			</td>
		</tr>


		<tr>
			<td>Content Description</td>
			<td><textarea class="summernote" name="contentDescription"></textarea></td>
		</tr>

		<tr>
			<td>Content</td>
			<td><textarea class="summernote" name="content"></textarea></td>
		</tr>

		<tr>
			<td>Content Meta Title</td>
			<td><input type="text" name="contentMetaTitle"></td>	
		</tr>

		<tr>
			<td>Content Meta Keyword</td>
			<td><input type="text" name="contentMetaKeyword"></td>	
		</tr>

		<tr>
			<td>Content Meta Description</td>
			<td><input type="text" name="contentMetaDescription"></td>	
		</tr>

		<tr>
			<td colspan="2"><input type="submit" name="submit" value="ADD"></td>
		</tr>
	</table>
</form>
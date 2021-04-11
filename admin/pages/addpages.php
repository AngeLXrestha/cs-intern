<?php
include('../database.php');
include('../includes/header.php');

if(isset($_POST['submit'])){
	//current date
	$currentDate = date('Y-m-d h:i:s');

	$status = '';
	if(isset($_POST['status'])){
	$status = mysqli_real_escape_string($cn, $_POST['status']);
	}

	$image = '';
	if(isset($_POST['image'])){
		$image = mysqli_real_escape_string($cn, $_POST['image']);
	}


	$title = mysqli_real_escape_string($cn, $_POST['title']);
	$description = mysqli_real_escape_string($cn, $_POST['description']);
	$insertDate = $currentDate;
	$updateDate = $currentDate;
	$metaTitle = mysqli_real_escape_string($cn, $_POST['metaTitle']);
	$metaKeyword = mysqli_real_escape_string($cn, $_POST['metaKeyword']);
	$metaDescription = mysqli_real_escape_string($cn, $_POST['metaDescription']);
	


	//checking whether the title with same name exists or not
	$query_check_title = "SELECT title FROM main WHERE `title`='$title';";
	$rs_check_title = mysqli_query($cn, $query_check_title) or die(mysqli_error($cn));
	if(mysqli_num_rows($rs_check_title)){
		$count = mysqli_num_rows($rs_check_title);
		$title1 = $title.($count + 1);
		//removing special characters from title form slug with '-'
		$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $title1);
		$titleSlug = trim(preg_replace('/\-+/', '-', $slug1));
	}
	else{	
		//removing special characters from title form slug with '-'
		$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $title);
		$titleSlug = trim(preg_replace('/\-+/', '-', $slug1));
	}

	$query_insert_main="INSERT INTO `main` 
	(`id`, 
	`title`, 
	`status`, 
	`description`, 
	`insertDate`, 
	`updateDate`, 
	`titleSlug`, 
	`metaTitle`, 
	`metaKeyword`, 
	`metaDescription`) 
	VALUES 
	(NULL, 
	'$title', 
	'$status', 
	'$description', 
	'$currentDate', 
	'$currentDate', 
	'$titleSlug', 
	'$metaTitle', 
	'$metaKeyword', 
	'$metaKeyword');";
	//inserting the data into main table
	$rs_insert_main=mysqli_query($cn, $query_insert_main) or die(mysqli_error($cn));

	//fething the id of instrted table i.e. main->id
	$m_id=mysqli_insert_id($cn);

	//Fetching the id from photo table to add in main_photo table as p_id
	$query_fetch_image_id="SELECT id from photo WHERE `titleName`='$image';";
	$rs_fetch_image_id=mysqli_query($cn, $query_fetch_image_id) or die(mysqli_error($cn));
	$row_fetch_image_id=mysqli_fetch_array($rs_fetch_image_id);
	$p_id=$row_fetch_image_id['id'];

	//Inserting into main_photo table
	$query_insert_main_photo="INSERT INTO `main_photo` (`id`, `p_id`, `m_id`) VALUES (NULL, '$p_id', '$m_id');";
	$rs_insert_main_photo=mysqli_query($cn, $query_insert_main_photo) or die(mysqli_error($cn));

	header('Location: index.php?msg=success');
	
}

?>

<form method="POST" >
<table>	
	<tr>
		<td>SITE TITLE</td>
		<td><input type="text" name="title"></td>
	</tr>

	<tr>
		<td>Status</td>
		<td>
			<input type="radio" name="status" value="1">Active
			<input type="radio" name="status" value="0">Innactive
		</td>
	</tr>

	<tr>
		<td>Description</td>
		<td><textarea class="summernote" name="description"></textarea></td>
	</tr>

	<tr>
		<td>Meta Title</td>
		<td><input type="text" name="metaTitle"></td>
	</tr>

	<tr>
		<td>Meta Keyword</td>
		<td><input type="text" name="metaKeyword"></td>
	</tr>

	<tr>
		<td>Meta Description</td>
		<td><textarea class="summernote" name="metaDescription"></textarea></td>
	</tr>

	<tr>
		<td>Image</td>
		<td>
			<label for="image"></label>
			<select name="image">
			<option value="" selected disabled hidden>Choose Image</option>
			<?php
			$query_fetch_image="SELECT titleName from photo";
			$rs_fetch_image=mysqli_query($cn, $query_fetch_image) or die(mysqli_error($cn));
			while($row_fetch_image=mysqli_fetch_array($rs_fetch_image)){
			?>
				<option value="<?php echo $row_fetch_image['titleName'];?>"><?php echo $row_fetch_image['titleName'];?></option>
			<?php
			}

			?>
			</section>
		</td>
	</tr>

	<tr>
		<td><input type="submit" name="submit" value="ADD"></td>
	</tr>
</table>
</form>
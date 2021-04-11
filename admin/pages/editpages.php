<?php
include('../database.php');
include('../includes/header.php');

//id of main table
$m_id=$_GET['id'];

//fetching all the data from main table where id is from get
$query1="SELECT * FROM main WHERE id=$m_id";
$rs1=mysqli_query($cn, $query1) or die(mysqli_error($cn));
$row1=mysqli_fetch_array($rs1);

//fetching p_id to fetch the file name from photo table
$query2="SELECT p_id from main_photo WHERE m_id=$m_id";
$rs2=mysqli_query($cn, $query2) or die(mysqli_error($cn));
$row2=mysqli_fetch_array($rs2);
$p_id=$row2['p_id'];

$query3="SELECT titleName from photo WHERE id=$p_id";
$rs3=mysqli_query($cn, $query3);
$row3=mysqli_fetch_array($rs3);
$selectedImage=$row3['titleName'];

if(isset($_POST['submit'])){


	//current date
	$currentDate=date('Y-m-d h:i:s');

	$status='';
	if(isset($_POST['status'])){
	$status=mysqli_real_escape_string($cn, $_POST['status']);
	}

	$image='';
	if(isset($_POST['image'])){
		$image=mysqli_real_escape_string($cn, $_POST['image']);
	}


	$title=mysqli_real_escape_string($cn, $_POST['title']);
	$description=mysqli_real_escape_string($cn, $_POST['description']);
	$insertDate=$currentDate;
	$updateDate=$currentDate;
	$metaTitle=mysqli_real_escape_string($cn, $_POST['metaTitle']);
	$metaKeyword=mysqli_real_escape_string($cn, $_POST['metaKeyword']);
	$metaDescription=mysqli_real_escape_string($cn, $_POST['metaDescription']);
	

	//removing special characters from title form slug with '-'
	$slug1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $title);
	$titleSlug = trim(preg_replace('/\-+/', '-', $slug1));

	$query="UPDATE `main`
	SET 
	`title` = '$title',
	`status`= '$status', 
	`description` = '$description', 
	`updateDate` = '$currentDate', 
	`titleSlug` = '$titleSlug', 
	`metaTitle` = '$metaTitle', 
	`metaKeyword` = '$metaKeyword', 
	`metaDescription` = '$metaDescription'
	WHERE 
	`main`.`id` = $m_id;";

	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
	
	$query4="SELECT id from photo where titleName='$image';";
	$rs4=mysqli_query($cn, $query4) or die(mysqli_error($cn));
	$row4=mysqli_fetch_array($rs4);
	$p_id=$row4['id'];

	$query5="UPDATE `main_photo` 
	SET 
	`p_id` = '$p_id' 
	WHERE 
	`main_photo`.`m_id` =$m_id";
	$rs5=mysqli_query($cn, $query5) or die(mysqli_error($cn));

	

header('Location: index.php?msg=update');
}

?>

<form method="POST" >
<table>	
	<tr>
		<td>SITE TITLE</td>
		<td><input type="text" name="title" value="<?php echo $row1['title']?>"></td>
	</tr>

	<tr>
		<td>Status</td>
		<td>
			<input type="radio" name="status" value="1" <?php if($row1['status']==1){echo "checked";}?>>Active
			<input type="radio" name="status" value="0" <?php if($row1['status']==0){echo "checked";}?>>Innactive
		</td>
	</tr>

	<tr>
		<td>Description</td>
		<td><textarea class="summernote" name="description"><?php echo $row1['description']?></textarea></td>
	</tr>

	<tr>
		<td>Meta Title</td>
		<td><input type="text" name="metaTitle" value="<?php echo $row1['metaTitle']?>"></td>
	</tr>

	<tr>
		<td>Meta Keyword</td>
		<td><input type="text" name="metaKeyword" value="<?php echo $row1['metaKeyword']?>"></td>
	</tr>

	<tr>
		<td>Meta Description</td>
		<td><textarea class="summernote" name="metaDescription"><?php echo $row1['metaDescription']?></textarea></td>
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
				<option value="<?php echo $row_fetch_image['titleName'];?>" <?php if($selectedImage==$row_fetch_image['titleName']){echo 'selected';} ?>> <?php echo $row_fetch_image['titleName'];?></option>
			<?php
			}

			?>
			</section>
		</td>
	</tr>

	<tr>
		<td><input type="submit" name="submit" value="update"></td>
	</tr>
</table>
</form>
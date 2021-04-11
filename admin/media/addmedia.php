<?php 
include('../includes/header.php');

if(isset($_POST['submit'])){
	$currentDate=date('Y-m-d');
	$year=date('Y');
	$month=date('m');
	$day=date('d');

	if(!file_exists('images/'.$year)){
		mkdir("images/$year");

	}
	if(!file_exists('images/'.$year.'/'.$month)){
			mkdir("images/$year/$month");
	}
	if(!file_exists('images/'.$year.'/'.$month.'/'.$day)){
		mkdir("images/$year/$month/$day");
	}


	$titleName=mysqli_real_escape_string($cn, $_POST['titleName']);
      $errors= array();
      $fileName = $_FILES['image']['name'];
      $fileSize =$_FILES['image']['size'];
      $fileTmp =$_FILES['image']['tmp_name'];
      $fileType=$_FILES['image']['type'];
      $fileExt=$imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($fileExt,$extensions)=== false){
         $errors[]="Extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($fileSize > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($fileTmp,"images/$year/$month/$day/".$fileName);
          $query="INSERT INTO `photo` 
          (`id`, `titleName`, `fileName`) 
          VALUES 
          (NULL, '$titleName', '$fileName');";
          $rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
          echo "Successfuly Uploaded";
      }else{
         foreach($errors as $key=>$value){
         	echo $value."<br>";
         }
      }

    
}

?>

<form action="" method="POST" enctype="multipart/form-data">

  <table border="1">
  	<tr>
  		<td>Title</td>
  		<td><input type="text" name="titleName"></td>
  	</tr>

  	<tr>
  		<td colspan="2">Select image to upload:<input type="file" name="image" id="image"></td>
  	</tr>

  	<tr>
  		<td colspan="2"><input type="submit" value="Upload Image" name="submit"></td>
  	</tr>
  </table>
</form>
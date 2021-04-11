<?php
define('BASE_URL', 'http://localhost/cs-intern/admin/');
define('BASE_PATH', 'D:\XAMPP\htdocs\cs-intern\admin\\');
include_once(BASE_PATH.'database.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>styles/style.css">

    <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    $(document).ready(function() {
 	$('.summernote').summernote();
	});
  </script>
</head>
<body>
<div class="content">
<div class="logo">
  <?php
    //fetching the logo of logo from g_settings 
    $query="SELECT logo FROM `g_settings`";
    $rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
    $row=mysqli_fetch_array($rs);
    $logo=$row['logo'];

    //feching the fileName and date from photo table which matches with the logo from above query
    $query1="SELECT `fileName`, `date` FROM photo WHERE `titleName`='$logo';";
    $rs1=mysqli_query($cn, $query1);
    $row1=mysqli_fetch_array($rs1);
    $fileName=$row1['fileName'];
    $date=$row1['date'];

    $new_date_format=strtotime($date);
    $year=date('Y', $new_date_format);
    $month=date('m', $new_date_format);
    $day=date('d', $new_date_format);

?> 
<img src="<?php echo BASE_URL.'media/images/'.$year.'/'.$month.'/'.$day.'/'.$fileName?>" height='100px'>
</div>  

<div class="navbar">
<a href="<?php echo BASE_URL?>dashboard.php">Dashboard</a>

<div class="dropdown">
  <button class="dropbtn">Page
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content">
      <a href="<?php echo BASE_URL?>/pages/index.php">List</a>
    <a href="<?php echo BASE_URL?>/pages/addpages.php">Add page</a>
  </div>
</div> 

<div class="dropdown">
  <button class="dropbtn">Media
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content">
      <a href="<?php echo BASE_URL?>/media/displaymedia.php">Gallery</a>
    <a href="<?php echo BASE_URL?>/media/addmedia.php">Add Image</a>
  </div>
</div> 

<div class="dropdown">
  <button class="dropbtn">POST
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content">
      <a href="<?php echo BASE_URL?>/content/content.php">Content</a>
    <a href="<?php echo BASE_URL?>/content/addcontent.php">Add Content</a>
    <a href="<?php echo BASE_URL?>/category/category.php">Category</a>
    <a href="<?php echo BASE_URL?>/category/addcategory.php">Add category</a>
  </div>
</div> 

<div class="dropdown">
  <button class="dropbtn">Settings
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content">
    <a href="<?php echo BASE_URL?>general-settings.php">General-settings</a>
    <a href="<?php echo BASE_URL?>change-password.php">Change-password</a>
  </div>
</div> 

<a href="<?php echo BASE_URL?>logout.php">Logout</a>
</div>
 

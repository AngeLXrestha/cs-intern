<?php 
include('../database.php');
if(isset($_GET['id'])){
	//fetch id of the cartgory

$id=mysqli_real_escape_string($cn, $_GET['id']);
$query="DELETE FROM blog_category WHERE id=$id";
$rs=mysqli_query($cn, $query) or die(mysqli_query($cn));

header('Location: category.php');
}

?>
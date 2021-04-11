<?php 
include('../database.php');

if(isset($_GET['id'])){
	//id from content table
	$id=$_GET['id'];
}

$query="DELETE FROM content WHERE id='$id';";
$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

header('Location: content.php');
?>
<?php
include('../database.php');
//id from main table
$id=$_GET['id'];

//delete from main
$query="DELETE FROM `main` WHERE `main`.`id` = $id";
$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

//delete from main_photo
$query1="DELETE FROM `main_photo` WHERE `main_photo`.`m_id` = $id";
$rs1=mysqli_query($cn, $query1) or die(mysqli_error($cn));

header('Location: index.php');
?>
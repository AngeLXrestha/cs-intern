<?php
include('../database.php');

//id from photo table
$p_id=mysqli_real_escape_string($cn, $_GET['id']);

$query="SELECT * FROM main_photo WHERE p_id='$p_id';";
$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
$row=mysqli_fetch_array($rs);
$id=$row['id'];
$m_id=$row['m_id'];

//delete data from photo table
$query1="DELETE FROM `photo` WHERE `photo`.`id` = '$p_id';";
$rs1=mysqli_query($cn, $query1);

//delete data from main_photo table
$query2="DELETE FROM `main_photo` WHERE `main_photo`.`id` = '$id';";
$rs2=mysqli_query($cn, $query2);

//delete data from main table
$query3="DELETE FROM `main` WHERE `main`.`id` ='$m_id';";
$rs2=mysqli_query($cn, $query2);

header('Location: displaymedia.php');

?>
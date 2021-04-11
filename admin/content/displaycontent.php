<?php 
include('../includes/header.php');
//id of category table
$category_id=$_GET['id'];

$query="SELECT * FROM content WHERE category_id='$category_id' ORDER BY id DESC;";
$rs=mysqli_query($cn, $query) or die(mysqli_erroe($cn));
if(mysqli_num_rows($rs)){
	while($row=mysqli_fetch_array($rs)){

	?>
	<div> <?php echo $row['contentTitleName'];?></div>
	<div> <?php echo $row['content'];?></div>
	<?php 
	}
}
else{
	echo "No content available";
}
include('../includes/footer.php');
?>
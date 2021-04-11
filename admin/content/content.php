<?php 
include('../includes/header.php');
//for pagination
 $limit = 3;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  

?>
<table border="1">
	<tr>
		<td>Content Title</td>
		<td>Category</td>
		<td>Image</td>
		<td>ContentDescription</td>
		<td>Content</td>
		<td>Content Meta Title</td>
		<td>Content Meta Keyowrd</td>
		<td>Content Meta Description</td>
		<td>Action</td>
	</tr>

	<?php
	$query="SELECT * FROM content ORDER BY id DESC LIMIT $start_from, $limit;";
	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
	while($row=mysqli_fetch_array($rs)){

	?>
	<tr>
		<td><?php echo $row['contentTitleName']?></td>
		<td><?php echo $row['categoryName']?></td>
		<td><?php echo $row['image']?></td>
		<td><?php echo $row['contentDescription']?></td>
		<td><?php echo $row['content']?></td>
		<td><?php echo $row['contentMetaTitle']?></td>
		<td><?php echo $row['contentMetaKeyword']?></td>
		<td><?php echo $row['contentMetaDescription']?></td>
		<td><a href="editcontent.php?id=<?php echo $row['id']?>"> Edit</a> / <a href="deletecontent.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure you want to delete?')"> Delete</td>
	</tr>
<?php } ?>
</table>

<?php
//display pagination
$result_db = mysqli_query($cn,"SELECT COUNT(id) FROM content"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit);
if($total_pages>1){

	/* echo  $total_pages; */
	$pagLink = "<ul class='pagination'>";  
	for ($i=1; $i<=$total_pages; $i++) {
	              $pagLink .= "<li class='page-item'><a class='page-link' href='content.php?page=".$i."'>".$i."</a></li>";	
	}
	echo $pagLink . "</ul>"; 
} 
include('../includes/footer.php');
?>

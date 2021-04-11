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


if(isset($_GET['msg'])){
	if($_GET['msg']=='update'){
		echo "Successfully Updated";
	}
	if($_GET['msg']=='add'){
		echo "Added new category";
	}
}


//fetching the category name from the blog_category table
$query="SELECT id,categoryName FROM blog_category ORDER BY id DESC LIMIT $start_from, $limit;";
$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));

?>
<table>
	<tr>
		<td><b>Category Name</b></td>
		<td><b>Action</b></td>
	</tr>

	
		<?php
			while($row=mysqli_fetch_array($rs)){
		?>
	<tr>
		<td><a href="../content/displaycontent.php?id=<?php echo $row['id']?>"> <?php echo $row['categoryName']; ?> </a></td>
		<td><a href="editcategory.php?id=<?php echo $row['id'];?>"> Edit</a>/<a href="deletecategory.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure you want to delete?')"> Delete</a></td>
	</tr>
	<?php }	?>
</table>

<?php
//display pagination
$result_db = mysqli_query($cn,"SELECT COUNT(id) FROM blog_category"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit);
if($total_pages>1){

	/* echo  $total_pages; */
	$pagLink = "<ul class='pagination'>";  
	for ($i=1; $i<=$total_pages; $i++) {
	              $pagLink .= "<li class='page-item'><a class='page-link' href='category.php?page=".$i."'>".$i."</a></li>";	
	}
	echo $pagLink . "</ul>"; 
} 
include('../includes/footer.php');
?>

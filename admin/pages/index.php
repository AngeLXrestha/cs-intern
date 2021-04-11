<?php
include('../includes/header.php');
?>

<table border="1">
	<tr>
		<td>Title</td>
		<td>Status</td>
		<td>Description</td>
		<td>Metatitle</td>
		<td>MetaKeyword</td>
		<td>MetaDescription</td>
		<td>Image</td>
		<td>Action</td>
	</tr>
	


<?php
//for pagination
 $limit = 2;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  

$query="SELECT * FROM main ORDER BY id DESC LIMIT $start_from, $limit;";
$rs=mysqli_query($cn, $query);
while($row=mysqli_fetch_array($rs)){
	//For displaying image
	$m_id=$row['id'];


	?>
		<tr>
			<td><?php echo $row['title']?></td>
			<td><?php if($row['status']==1){echo "Active";}else{echo "Innactive";} ?></td>
			<td><?php echo $row['description']?></td>
			<td><?php echo $row['metaTitle']?></td>
			<td><?php echo $row['metaKeyword']?></td>
			<td><?php echo $row['metaDescription']?></td>
	<?php
	//fetching the id from photo table
	$query1="SELECT p_id from main_photo WHERE m_id='$m_id';";
	$rs1=mysqli_query($cn, $query1) or die(mysqli_error($cn));
	if(mysqli_num_rows($rs1)!=0){
		$row1=mysqli_fetch_array($rs1);
		$p_id=$row1['p_id'];
	
	
		//fetching the titleName of the photo from photo table
		$query2="SELECT titleName from photo WHERE id=$p_id";
		$rs2=mysqli_query($cn, $query2) or die(mysqli_error($cn));
		if(!mysqli_num_rows($rs2)==0){
		$row2=mysqli_fetch_array($rs2);
		}
	?>
	<td><?php echo $row2['titleName']; 
	}
	else
	{
		echo "<td>No image available</td>";
	}
	?></td>

	<td><a href="editpages.php?id=<?php echo $m_id?>"> Edit</a> / <a href="deletePages.php?id=<?php echo $m_id?>" onclick="return confirm('Are you sure you want to delete?')"> Delete</a></td>


	</tr>
	<?php
}
?>

</table>

<?php
//display pagination
$result_db = mysqli_query($cn,"SELECT COUNT(id) FROM main"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit);
if($total_pages>1){

	/* echo  $total_pages; */
	$pagLink = "<ul class='pagination'>";  
	for ($i=1; $i<=$total_pages; $i++) {
	              $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a></li>";	
	}
	echo $pagLink . "</ul>"; 
} 

include('../includes/footer.php');

?>
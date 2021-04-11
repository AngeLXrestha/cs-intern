<?php
include('../includes/header.php');

//for pagination
 $limit = 2;  
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
		<td>Title Name</td>
		<td>Image</td>
		<td>Action</td>
	</tr>

	
		<?php
			$query="SELECT * FROM photo ORDER BY id DESC LIMIT $start_from, $limit;";
			$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
			while($row=mysqli_fetch_array($rs)){
				$date=$row['date'];
				$old_date_timestamp = strtotime($date);
				$year = date('Y', $old_date_timestamp); 
				$month=date('m', $old_date_timestamp);
				$day=date('d', $old_date_timestamp);

		?>
		<tr>
		<td><?php echo $row['titleName']?> </td>
		<td><img src="images/<?php echo $year.'/'.$month.'/'.$day.'/'.$row['fileName']?>"></td>
		<td><a href="editmedia.php?id=<?php echo $row['id']?>"> Edit</a>/ <a href="deletemedia.php?id=<?php echo $row['id']; ?>"onclick="return confirm('Are you sure you want to delete?')">Delete</td>
		</tr>
	<?php } ?>
	
</table>

<?php
//display pagination
$result_db = mysqli_query($cn,"SELECT COUNT(id) FROM photo"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit);
if($total_pages>1){

	/* echo  $total_pages; */
	$pagLink = "<ul class='pagination'>";  
	for ($i=1; $i<=$total_pages; $i++) {
	              $pagLink .= "<li class='page-item'><a class='page-link' href='displaymedia.php?page=".$i."'>".$i."</a></li>";	
	}
	echo $pagLink . "</ul>"; 
} 


include('../includes/footer.php');
?>

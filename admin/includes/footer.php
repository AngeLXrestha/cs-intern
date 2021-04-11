<?php
include('D:\XAMPP\htdocs\cs-intern\admin\database.php');
?>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/styles/footer.css">
<footer class="footer">
	<?php 
	$query="SELECT footerContent from g_settings";
	$rs=mysqli_query($cn, $query) or die(mysqli_error($cn));
	$row=mysqli_fetch_array($rs);
	echo $row['footerContent'];
	?>
</footer>
</body>
</html>
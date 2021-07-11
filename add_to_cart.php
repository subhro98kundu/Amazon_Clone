<?php
include("includes/dbhelper.php");
?>
<?php
	session_start();
	
	$product_id = $_GET['product_id'];
	$user_id = $_SESSION['user_id'];
	$query = "INSERT INTO cart VALUES (NULL,$user_id,$product_id,1)";
	if(mysqli_query($conn, $query)){
		echo 1;
	}else{
		echo 0;
	}
	echo($product_id);
?>
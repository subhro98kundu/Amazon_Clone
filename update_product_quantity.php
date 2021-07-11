<?php
include("includes/dbhelper.php");
?>
<?php
	session_start();
	
	$product_id = $_GET['product_id'];
	$quantity = $_GET['quantity'];
	$sign = $_GET['sign'];
	$user_id = $_SESSION['user_id'];
	if($sign === '-')
		$quantity-=1;
	else
		$quantity+=1;
	if($quantity == 0)
		$query = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
	else
		$query = "UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
	if(mysqli_query($conn, $query)){
		echo $sign;
	}else{
		echo $sign;
	}
	//echo($product_id);
?>
<?php 
include("includes/dbhelper.php");
session_start();
$payment_method = $_POST['payment'];
$order_id = $_POST['order_id'];
$user_id = $_SESSION['user_id'];
$query = "UPDATE orders SET payment_method = '$payment_method', status = 1 WHERE order_id = '$order_id'";

if(mysqli_query($conn,$query)){
		$query1 = "DELETE FROM cart WHERE user_id = $user_id";
		if(mysqli_query($conn, $query1)){
			header('Location:success_page.php?order_id='.$order_id);
		}else{
			header('Location:payment_mode.php?error=1&order_id='.$order_id);
		}
}else{
		header('Location:payment_mode.php?error=0&order_id='.$order_id);
}
 ?>

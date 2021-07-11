<?php
	session_start();
	if(empty($_SESSION)){
		header('Location:login_form.php');
	}else{
		$is_logged_in = 1;
		$user_id = $_SESSION['user_id'];
		//echo $user_id;
	}
	
?>

<?php 
	
	session_start();
	include("includes/dbhelper.php");
	$order_id = $_POST['order_id'];
	$address_id = $_POST['address'];
	$query = "UPDATE orders SET address = $address_id WHERE order_id = '$order_id'";
	if(mysqli_query($conn, $query)){
		header('Location:payment_mode.php?order_id='.$order_id);
	}
	else{
		echo "<script>alert('Oops! Some error occured!!');</script>";
		header('Location:show_address.php?order_id='.$order_id);
	}
	include("header.php");
	print_r($_POST);

 ?>
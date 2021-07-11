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

	//session_start();
	include('includes/dbhelper.php');
	$user_id = $_SESSION['user_id'];
	$street_address = $_POST['street_address'];
	$landmark = $_POST['landmark'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$pin = $_POST['pin'];
	$contact_number = $_POST['contact_number'];

	$query = "INSERT INTO address VALUES (NULL, $user_id, '$street_address', '$landmark', '$city', '$state', '$pin', '$contact_number')";
	echo $query;
	if(mysqli_query($conn, $query)){
		header('Location:show_address.php?order_id='.$order_id);
	}else{
		echo 'some error occured';
	}
 ?>
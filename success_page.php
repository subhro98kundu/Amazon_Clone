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
 include("includes/dbhelper.php");
 include("header.php");
 $order_id = $_GET['order_id'];
 $query="SELECT * FROM orders WHERE order_id='$order_id' AND user_id=$user_id";
 $result = mysqli_query($conn, $query);
 //print_r($result);
 $num_rows = mysqli_num_rows($result);
 if($num_rows == 0){
 	header('Location:login_form.php');
 }
 ?>

 <div class="container mt-5 p-5">
 	<h1 style="color:green;">Your order has been successfully placed.</h1>
 </div>

 </body>
 </html>
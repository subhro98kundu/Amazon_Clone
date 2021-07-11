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
 include("includes/header.php");
 ?>

 <div class="container mt-5">
 	<form action="payment_confirmation.php" method="post">
 		<input type="radio" name="payment" value="Credit Card" class="mr-3">Credit Card<br><br><br>
 		<input type="radio" name="payment" value="Debit Card" class="mr-3">Debit Card<br><br><br>

 		<input type="radio" name="payment" value="UPI" class="mr-3">UPI<br><br><br>
 		<input type="radio" name="payment" value="Net Banking" class="mr-3">Net Banking<br><br><br>


 		<input type="radio" name="payment" value="Cash on Delivery" class="mr-3">Cash on Delivery<br><br><br>

 		<input type="hidden" name="order_id" value="<?php echo($_GET['order_id']); ?>"><br>
 		<input type="submit" name="" class="btn btn-primary btn-lg" value="Proceed to Pay" style="float: right;">
 		
 	</form>
 </div>
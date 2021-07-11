<?php
	session_start();
	if(empty($_SESSION)){
		header('Location:login_form.php');
	}else{
		$is_logged_in = 1;
		$user_id = $_SESSION['user_id'];
	}
	
?>

<?php
 include("includes/dbhelper.php");
 include("header.php");
 ?>

 <div class="container">
	<h1 class="mt-5">Cart</h1>
	<div class="row">
		<div class="col-8">
			<?php 
				$query = "SELECT * FROM cart w JOIN products p ON w.product_id = p.product_id WHERE w.user_id = $user_id";
				$result = mysqli_query($conn, $query);
				$counter = 0;
				$amount = 0;
				while($row = mysqli_fetch_assoc($result)){
					$amount += $row['price']*$row['quantity'];
					$product_id = $row['product_id'];
					$img_path = explode(',',$row['bg'])[0];
  					$img_path = substr($img_path, 2, strlen($img_path)-3);
					echo '<div id="card'.$product_id.'" class="card mt-3 p-3">
				<div class="row">
					<div class="col-3">
						<img src="'.$img_path.'" style="width:100%">
					</div>
					<div class="col-6">
						<h5 class="mt-3">'.$row['name'].'</h5>
						<h6>Rs. <span id="price'.$product_id.'">'.$row['price'].'</span></h6>
					</div>
					<div class="col-3">
						<button data-id="'.$row['product_id'].'" class="btn btn-primary btn-sm plus-one">-</button>
						<span id="quantity'.$product_id.'"><b>'.$row['quantity'].'</b></span>
						<button data-id="'.$row['product_id'].'" class="btn btn-primary btn-sm plus-one">+</button>
					</div>
				</div>
			</div>';
			$counter++;
				}
				if($counter==0){
					echo "<h3>You have no items in the cart.</h3>";
				}else{
					echo '<div id="totaldiv"><hr>
			 <h3 style="display:inline;">Total Amount Rs. <span id="total">'.$amount.'</span></h3>
			 <a href="place_order.php" class="btn btn-primary btn-lg text-dark" style="float: right;">Checkout</a></div>';
				}
			 ?>
			 
			
		</div>
		
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$('.plus-one').click(function(){
		//fetch the product id of clicked button
		var sign = $(this).text();
		console.log(sign);
		var product_id = $(this).attr('data-id');
		var quantity = $('#quantity'+product_id).text();
		var total = $('#total').text();
		var price = $('#price'+product_id).text();
		$.ajax({
			url:'update_product_quantity.php?product_id=' + product_id + '&quantity=' + Number(quantity) + '&sign=' + sign,
			method: 'GET',
			success: function(data){
				console.log(data);
				if(sign == '+'){
				quantity = Number(quantity)+1;
				$('#quantity'+product_id).text(quantity);
				$('#total').text(Number(total)+Number(price));
			}else{
				quantity = Number(quantity) - 1;
				$('#quantity'+product_id).text(quantity);
				$('#total').text(Number(total)-Number(price));
				if(Number(quantity) === 0){
					/*$.ajax({
						url:'remove_product_from_cart.php?product_id='+product_id,
						type:'GET',
						success: function(data){
							console.log(data);
						},
						error: function(error){
							console.log(error);
						}
					})*/
					$('#card'+product_id).remove();
					if(Number(total)-Number(price) == 0){
						$('#totaldiv').remove();
					}
				}
			}
			},
			error: function(){
				console.log(data);
			}
		})
	})
</script>
<?php
  session_start();
  $conn = mysqli_connect("localhost", "root","","amazon");
  if(!empty($_SESSION)){
    $is_logged_in =1;
  }else{
    $is_logged_in =0;
  }
  $user_id = $_SESSION['user_id'];
  $product_id = $_GET['id'];
  $query = "SELECT * FROM products WHERE product_id = $product_id";
  $result = mysqli_query($conn,$query);
  $result = mysqli_fetch_assoc($result);
  $img_path = explode(',',$result['bg'])[0];
  $img_path = substr($img_path, 2, strlen($img_path)-3);
 // echo $img_path;

  $query2 = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
  $result2 = mysqli_query($conn,$query2);
  $num_rows = mysqli_num_rows($result2);

  $query3 = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
  $result3 = mysqli_query($conn,$query3);
  $num_rows2 = mysqli_num_rows($result3);

?>

<?php include("header.php"); ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-6">
        <img src="<?php echo $img_path; ?>" style="width: 100%;">
      </div>
      <div class="col-6">
        <h1><?php echo $result['name']; ?></h1>
        <h4><?php echo $result['price']; ?></h4>
        <p><?php echo $result['details'] ?></p>
        <button class="btn btn-primary btn-lg" id="cart-btn">Add to Cart</button>
        <button id="wishlist-btn" class="btn btn-dark btn-lg">Wishlist</button>
      </div>
    </div>
  </div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    if(<?php echo $num_rows ?>){
      $('#wishlist-btn').disabled = true;
      $('#wishlist-btn').html('Wishlisted');
    }else{
    $('#wishlist-btn').click(function(){
      $.ajax({
        url: 'add_wishlist.php?product_id='+<?php echo $product_id; ?>,
        method: 'GET',
        success: function(data){
          console.log(data);
          $('#wishlist-btn').html('Wishlisted');
        },
        error: function(error){
          console.log("error has occured.");
        }
      })
    })
  }
  })

  if(<?php echo $num_rows2 ?>){
    $('#cart-btn').disabled = true;
    $('#cart-btn').html('Added');
  }else{
  $('#cart-btn').click(function(){
    // ajax to insert into cart
    $.ajax({
      url: 'add_to_cart.php?product_id='+<?php echo $product_id; ?>,
        method: 'GET',
        success: function(data){
          $('#cart-btn').html('Added');
          
        },
        error: function(error){
          console.log("error has occured.");
        }
    })
  
  })
}
</script>
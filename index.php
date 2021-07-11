<?php
  session_start();
  $conn = mysqli_connect("localhost", "root","","amazon");
  if(!empty($_SESSION)){
    $is_logged_in =1;
  }else{
    $is_logged_in =0;
  }
  include("header.php");
?>

<div class="box">
  <div id="carouselExampleControls" class="carousel slide box" data-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://images-eu.ssl-images-amazon.com/images/G/31/img21/Wireless/Xiaomi/Redmi_EVOSeries/Note10Pro/GW/May/D21342631_WLD_Mi_Redmi_Note10Pro_tallhero_1500x600._CB667000819_.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images-eu.ssl-images-amazon.com/images/G/31/img19/AmazonPay/Avatar/HeroPC_1500x600_SVA._CB667240774_.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images-eu.ssl-images-amazon.com/images/G/31/Sports/Fitness_1500x600_New._CB669481512_.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  
</div></div>
<div class="overlay p-5">
  <div class="container">
    <h1 class="mt-5">Furniture</h1>

    <div class="row mt-2 mb-5">
      <?php
      $query = "SELECT * FROM products WHERE category LIKE '%Furniture%'";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_assoc($result)){
        $str = explode(',', $row['bg'])[0];
        $str = substr($str,2,strlen($str)-3);
        //print_r($row);
        echo '<div class="col-3"><a href="details.php?id='.$row['product_id'].'">
        <div class="card">
        <div class="card-body">
          <img src="'.$str.'" class="card-img-top" height="200px">
          <h5 class="card-title">'.$row['name'].'</h5>
          <p class="card-text">'.$row['price'].'</p>
        </div>
      </div></a>  
      </div>';
      }
    ?>
      
    </div>
  </div>
  <div class="container" style="">
    <h1 class="mt-5">Clothing</h1>

    <div class="row mt-2 mb-5">
      <?php
      $query = "SELECT * FROM products WHERE category LIKE '%Clothing%'";
      $result = mysqli_query($conn, $query);
      $counter = 0;
      while($row = mysqli_fetch_assoc($result)){
        if($counter<6){
        $str = explode(',', $row['bg'])[0];
        $str = substr($str,2,strlen($str)-3);
        //print_r($row);
        echo '<div class="col-2"><a href="details.php?id='.$row['product_id'].'">
        <div class="card">
        <div class="card-body">
          <img src="'.$str.'" class="card-img-top" height="200px">
          <h5 class="card-title">'.$row['name'].'</h5>
          <p class="card-text">'.$row['price'].'</p>
        </div>
      </div></a>  
      </div>';
      $counter++;
      }
      }
    ?>
      
    </div>
  </div>

  <div class="container" style="">
    <h1 class="mt-5">Footwear</h1>

    <div class="row mt-2 mb-5">
      <?php
      $query = "SELECT * FROM products WHERE category LIKE '%Footwear%'";
      $result = mysqli_query($conn, $query);
      $counter = 0;
      while($row = mysqli_fetch_assoc($result)){
        if($counter<4){
        $str = explode(',', $row['bg'])[0];
        $str = substr($str,2,strlen($str)-3);
        //print_r($row);
        echo '<div class="col-3"><a href="details.php?id='.$row['product_id'].'">
        <div class="card">
        <div class="card-body">
          <img src="'.$str.'" class="card-img-top" height="200px">
          <h5 class="card-title">'.$row['name'].'</h5>
          <p class="card-text">'.$row['price'].'</p>
        </div></a>
      </div>  
      </div>';
      $counter++;
      }
      }
    ?>
      
    </div>
  </div>  
</div>
</body>
</html>
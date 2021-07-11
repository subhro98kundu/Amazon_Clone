<?php
session_start();

$conn = mysqli_connect("localhost", "root","","amazon");

//step2
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

//step 3
$query = "INSERT INTO USERS VALUES (NULL, '$name','$email','$password')";
$query1 = "SELECT * FROM users WHERE email LIKE '$email'";
$result = mysqli_query($conn,$query1);
//$result = mysqli_fetch_assoc($result);
$num_rows = mysqli_num_rows($result);

if($num_rows == 0){
if(mysqli_query($conn,$query)){
	$query2 = "SELECT * FROM users WHERE email LIKE '$email'";
	$result2 = mysqli_query($conn, $query2);
	$result2_arr = mysqli_fetch_assoc($result2);
	$_SESSION['name'] = $result2_arr['name'];
	$_SESSION['user_id'] = $result2_arr['user_id'];

	header('Location:index.php');
}else{
	//echo "Error occured";
	header('Location:registration_form.php?error=0');
}
}else{
	//echo("already registered");
	header('Location:registration_form.php?error=1');
}
?>
<?php
session_start();

include("../db/db.php");

	if(isset($_POST['sign_in'])){

	$email = htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
	$pass = htmlentities(mysqli_real_escape_string($conn,$_POST['pass']));

	$select_user = "SELECT * from users WHERE email ='$email' AND password ='$pass'";

	$query = mysqli_query($conn,$select_user);

	$check_user = mysqli_num_rows($query);

	if($check_user==1){

  	$_SESSION['email'] = $email;

  	$update_msg = mysqli_query($conn, "UPDATE users SET log_in='Online' WHERE email='$email'");

  	$user = $_SESSION['email'];
  	$get_user = "SELECT * FROM users WHERE email='$user'";
  	$run_user = mysqli_query($conn,$get_user);
  	$row = mysqli_fetch_array($run_user);

	$user_name = $row['username'];
	$_SESSION['user_name'] = $user_name;

  	echo "<script>window.open('profiles/dashboard.php?user_name=$user_name','_self')</script>";

	}
	else {
	echo "
	<div class='alert alert-danger'>
	  <strong>Check your email and password!</strong>
	</div>
	";}
	}
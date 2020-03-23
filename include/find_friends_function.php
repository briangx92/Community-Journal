<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "community-journal";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	function search_user(){

		global $conn;

		if(isset($_GET['search_btn'])){
			$search_query = htmlentities($_GET['search_query']);
			$get_user = "SELECT * from users where username like '%$search_query%' or country like '%$search_query%'";
		}
		else{
			$get_user = "SELECT * from users ORDER BY country, username DESC LIMIT 15";
		}

		$run_user = mysqli_query($conn,$get_user);

		while($row_user=mysqli_fetch_array($run_user)){

		  $user_name = $row_user['username'];
		  $country = $row_user['country'];
		  $gender = $row_user['gender'];

			//now displaying all at once

			echo "
			<div class='card'>
		      <h1>$user_name</h1>
		      <p class='title'>$country</p>
		      <p>$gender</p>
		      <form method='post'>
		        <p><button name='add'>Chat with $user_name</button></p>
		      </form>
		    </div><br><br>
			";

		if(isset($_POST['add'])){
			echo "<script>window.open('../views/messages.php?user_name=$user_name','_self')</script>";
		}
	}

	}
?>

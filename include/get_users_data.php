<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "community-journal";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
	$user = "select * from users";

	$run_user = mysqli_query($conn,$user);

	while ($row_user=mysqli_fetch_array($run_user)){

	$user_id = $row_user['user_id'];
	$user_name = $row_user['username'];
	// $user_profile = $row_user['user_profile']; <img src='$user_profile'>
	$login = $row_user['log_in'];
	echo"
	<li>
		<div class='chat-left-img'>

		</div>
		<div class='chat-left-detail'>
			<p><a href='../views/messages.php?user_name=$user_name'>$user_name</a></p>";
			if($login == 'Online'){
			echo "<span><i class='fa fa-circle' aria-hidden='true'></i> Online</span>";
			}else{
			echo "<span><i class='fa fa-circle-o' aria-hidden='true'></i> Offline</span>";
			}

			"
		</div>
	</li>

	";
	}
?>
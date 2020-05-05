<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "community-journal";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
	$user = "SELECT * FROM users JOIN friends ON users.email = friends.sender WHERE username!='$_SESSION[username]' AND status = 1 AND receiver = '$_SESSION[username]'";

	$run_user = mysqli_query($conn,$user);

	if (mysqli_num_rows($run_user)==0) {
		echo '<h2 style="color:red;text-align:center;">You have no friends at the moment</h2>';
	}

	while ($row_user=mysqli_fetch_array($run_user)){

		$user_id = $row_user['user_id'];
		$user_name = $row_user['username'];
		// $user_profile = $row_user['user_profile']; <img src='$user_profile'>
		$login = $row_user['log_in'];

		echo"<li>
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

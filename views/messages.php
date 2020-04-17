<!DOCTYPE html>
<?php
session_start();
print_r($_SESSION);
include("../db/db.php");
if (!isset($_SESSION['email'])) {
	header("location: index.php");
}
if (isset($_POST['logout'])) {
	$update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
	session_destroy();
	header("location: ../");
} else { ?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<!-- <header>
        Header Nav
        <nav>
            <ul>
                <a href="dashboard.php"><img class = "img-link" src="../Pictures/logo.png" alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
                <li><a href="../views/messages.php">Messages</a></li>
                <li><a href="public.php">Public</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><input class ='search-nav' type="text" name="search" placeholder="Search"></li>
                <form method="post" class = "logout-nav">
                    <button type="submit" class="btn" name = "logout">Logout</button>
                </form>
            </ul>
        </nav>
    </header> -->

<body>
    <div class="container main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                <!-- list on the left side -->
                <div class="left-chat">
                    <ul>
                        <?php include("../include/get_users_data.php"); ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                <div class="row">
                    <!-- getting the user information who is logged in -->
                    <?php
						$user = $_SESSION['email'];
						$get_user = "SELECT * FROM users WHERE email='$user'";
						$run_user = mysqli_query($conn, $get_user);
						$row = mysqli_fetch_array($run_user);
						$user_id = $row['user_id'];
						$user_name = $row['username'];
						echo ( "Logged in: " . $user_name);
						?>
                    <!-- getting the user data on which user click -->
                    <?php
						if (isset($_GET['user_name'])) {
							global $conn;
							$get_username = $_GET['user_name'];
							$get_user = "SELECT * FROM users WHERE username='$get_username'";
							$run_user = mysqli_query($conn, $get_user);
							$row_user = mysqli_fetch_array($run_user);
							$username = $row_user['username'];
							$total_messages = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND reciever_username='$username') OR (reciever_username='$user_name' AND sender_username='$username')";
							$run_messages = mysqli_query($conn, $total_messages);
							$total = mysqli_num_rows($run_messages);
							echo ( "Other User: " . $username);
						}
						?>
                    <div class="col-md-12 right-header">
                        <div class="right-header-detail">
                            <form method="post">
								<p><?php 
								if (empty($get_username)) {
									echo ("$_SESSION[user_name]");
								} else {
									echo ($get_username);
								}
								?></p>
								<span><?php  
									if (!empty($total)){
										if ($total == 1){
											echo $total;
											echo " message";
										} else {
											echo $total;
											echo " messages";
										}
									}
								 ?> </span>
                                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                        <?php
							if ($_SERVER["REQUEST_METHOD"] == "GET") {
								$update_msg = mysqli_query($conn, "UPDATE users_chat SET msg_status='read' WHERE sender_username='$_SESSION[user_name]' AND reciever_username='$user_name'");
								if (!empty($username)) {
									$sel_msg = "SELECT * FROM users_chat WHERE (sender_username='$_SESSION[user_name]' AND reciever_username='$username') OR (reciever_username='_SESSION[user_name]' AND sender_username='$user_name') ORDER by 1 ASC";
									$run_msg = mysqli_query($conn, $sel_msg);
									while ($row = mysqli_fetch_array($run_msg)) {
										$sender_username = $row['sender_username'];
										$reciever_username = $row['reciever_username'];
										$msg_content = $row['msg_content'];
										$msg_status = $row['msg_status'];
										$msg_date = $row['msg_date'];
									}
								}
							}
							
							?>
                        <ul>
                            <?php
								if ($_SERVER["REQUEST_METHOD"] == "GET") {
									if (!empty($sender_username)) {
										if ($user_name == $sender_username and $username == $reciever_username) {
											echo "
												<li>
													<div class='rightside-right-chat'>
														<span> $user_name <small>$msg_date</small> </span><br><br>
														<p>$msg_content</p>
													</div>
												</li>
											";
										}
									}
								}
								if (!empty($username)) {
									$new_msg = "SELECT * FROM users_chat WHERE reciever_username='$_SESSION[user_name]' AND sender_username='$username' ORDER by 1 ASC";
									$please_msg = mysqli_query($conn, $new_msg);
									while ($row2 = mysqli_fetch_array($please_msg)) {
										$sender_username2 = $row2['sender_username'];
										$reciever_username2 = $row2['reciever_username'];
										$msg_content2 = $row2['msg_content'];
										$msg_status2 = $row2['msg_status'];
										$msg_date2 = $row2['msg_date'];
									}
									if (!empty($sender_username2) and !empty($reciever_username2) and !empty($msg_content2) and !empty($msg_status2) and !empty($msg_date2)) {
										echo "
										<li>
											<div class='rightside-left-chat'>
												<span> $username <small>$msg_date2</small> </span><br><br>
												<p>$msg_content2</p>
											</div>
										</li>
										";
									}
								}			
						
					?>
                        
                        <?php
						
							
							?>
							</ul>
                        <!-- Have to close the while loop after closing ul -->
                    </div>
                </div>
                <!-- Form for writing your message -->
                <div class="row">
                    <div class="col-md-12 right-chat-textbox">
                        <form method="post">
                            <input autocomplete="off" type="text" name="msg_content"
                                placeholder="Write your message...">
                            <button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Handle messages -->
    <?php
		if (isset($_POST['submit'])) {
			$msg = htmlentities($_POST['msg_content']);
			if ($msg == "") {
				echo "
				<div class='alert alert-danger'>
				  <strong><center>Message was unable to send!</center></strong>
				</div>
				";
			} else if (strlen($msg) > 100) {
				echo "
				<div class='alert alert-danger'>
				  <strong><center>Message is Too long! Use only 100 characters</center></strong>
				</div>
				";
			} else {
				$insert = "INSERT INTO `users_chat` (`sender_username`, `reciever_username`, `msg_content`, `msg_status`, `msg_date`) VALUES ('$user_name', '$username', '$msg', 'unread', current_timestamp());";
				$run_insert = mysqli_query($conn, $insert);
			}
		}
		?>
    <script>
    $('#scrolling_to_bottom').animate({
        scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight
    }, 1000);
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        var height = $(window).height();
        $('.left-chat').css('height', (height - 92) + 'px');
        $('.right-header-contentChat').css('height', (height - 163) + 'px');
    });
    </script>
</body>

</html>
<?php } ?>
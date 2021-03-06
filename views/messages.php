<!DOCTYPE html>
<?php
session_start();
include("../db/db.php");
if (!isset($_SESSION['email'])) {
	header("location: index.php");
}
if (isset($_POST['logout'])) {
    $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE email= '" . $_SESSION['email'] . "'");
	session_destroy();
	header("location: ../");
} else { ?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="icon" href="../Pictures/logo.png">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="container main-section">
        <ul>
            <a href="../profiles/dashboard.php"><img class="img-link" src="../Pictures/logo.png"
                    alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
        </ul>

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
						}
						?>
                    <div class="col-md-12 right-header">
                        <div class="right-header-detail">
                            <form method="post">

								<p><?php 
								if (empty($get_username)) {
									echo ("$_SESSION[username]");
								} else {
									echo ($get_username);
								}
								?></p>
								<button type="submit" name="logout" class="btn btn-danger">Logout</button>
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
                    
										?> 
                              </span>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                        <ul>

						<?php
							if ($_SERVER["REQUEST_METHOD"] == "GET") {
								if (!empty($username)) {
									$update_msg = mysqli_query($conn, "UPDATE users_chat SET msg_status='read' WHERE reciever_username='$_SESSION[username]' AND sender_username='$username'");
								}
								if (!empty($username)) {
									$sel_msg = "SELECT * FROM users_chat WHERE (sender_username='$_SESSION[username]' AND reciever_username='$username') OR (reciever_username='$_SESSION[username]' AND sender_username='$username') ORDER by msg_date ASC";
									$run_msg = mysqli_query($conn, $sel_msg);
									$pre = '';
									while ($row = mysqli_fetch_array($run_msg)) {
										$sender_username = $row['sender_username'];
										$reciever_username = $row['reciever_username'];
										$msg_content = $row['msg_content'];
										$msg_status = $row['msg_status'];
										$msg_date = $row['msg_date'];


											if ($row['sender_username'] == $username) {
												echo "
												<li>
													<div class='rightside-right-chat'>
														<span> $username <small>$msg_date</small> </span><br><br>
														<p>$msg_content</p>
													</div>
												</li>
											";
											} else {
												echo "
											<li>
												<div class='rightside-left-chat'>
													<span> $user_name <small>$msg_date</small> </span><br><br>
													<p>$msg_content</p>
												</div>
											</li>
											";
												$row['msg_date'] == $pre;
											}
										}
									}
								}

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
				header("Location: http://localhost/Community-Journal/views/messages.php?user_name=$username");
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
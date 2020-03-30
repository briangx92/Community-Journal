<!DOCTYPE html>
<?php
session_start();
include("../include/find_friends_function.php");


if(!isset($_SESSION['user_email'])){

  header("location: index.php");

}
else { ?>

<html>
<head>
  <title>Find Friends</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/find_people.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">



  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">
    <div class="">
        <img src="/Applications/XAMPP/xamppfiles/htdocs/Community-Journal/Pictures/logo.png" alt="">
    </div>

    <?php
      $user = $_SESSION['email'];
      $get_user = "SELECT * FROM users WHERE email='$user'";
      $run_user = mysqli_query($conn,$get_user);
      $row=mysqli_fetch_array($run_user);

      $user_name = $row['username'];
      echo"<a class='navbar-brand' href='messages.php?user_name=$user_name'>MyChat</a>";
    ?>
  </a>


  <!-- Links -->
  <ul class="navbar-nav">
    <li><a style="color: white; text-decoration: none;font-size: 20px;" href="../account_settings.php">Settings</a></li>
  </ul>
</nav><br>
<div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
    <FROM class="search_FROM" action="">
      <input type="text" placeholder="Search Friends" autocomplete="off" name="search_query" required>
      <button class="btn" type="submit" name="search_btn">Search</button>
    </FROM>
    </div>
    <div class="col-sm-4">
    </div>
</div>
<br>
<br>
<?php search_user();?>
</body>
</html
<?php } ?>

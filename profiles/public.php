<?php
require('../include/login.php');
include('../db/db.php');

$email = $_SESSION['email'];
$_GLOBALS['email'] = $email;


if (isset($_POST['logout'])) {
    $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
    session_destroy();
    header("location: ../");
}


?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Public Page</title>
</head>

<body>
    <header>
        <!-- Header Nav -->
        <nav>
            <ul>
                <a href="dashboard.php"><img class="img-link" src="../Pictures/logo.png"
                        alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
                <li><a href="../views/messages.php">Messages</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><input class='search-nav' type="text" name="search" placeholder="Search"></li>
                <form method="post" class="logout-nav">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
            </ul>
        </nav>
    </header>


    <div class="container" style="width:500px;">

        <br>
        <label>Create a Post</label>
        <form action="public.php" method="post">
            <input type="text" name="title" placeholder="Title...">
            <textarea placeholder="What's on your mind?" cols="40" rows="10" name="content"></textarea>
            <input type="file" name="image" id="image">
            <input type="submit" name="submit" class="btn btn-info">

        </form>
        <table>



        </table>
        <?php

        if ($_POST['submit']) {

            $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            $content = $_POST['content'];
            $title = $_POST['title'];
            $query = "INSERT INTO user_blog (blog_pic, content, blog_owner, title) VALUES ('{$file}', '{$content}', '{$email}', '{$title}')";
            mysqli_query($conn, $query);
        }

        ?>
    </div>

    <footer class='login-footer'>
        <ul>
            <li>Phone: 717-555-5555</li>
            <li>Email: CommunityJournal@gmail.com</li>
            <li>Fax: 171-123-4567</li>
        </ul>
    </footer>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>
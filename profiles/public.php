<?php
require('../include/login.php');
include('../db/db.php');

$email = $_SESSION['email'];
$_GLOBALS['email'] = $email;

include '../include/cookies.php';

if (isset($_POST['logout'])) {
    $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['email'] . "'");
    // Unset all of the session variables.
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
    header("location: ../");
    include '../include/cookies.php';
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
                <form method="post" class="logout-nav">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
                <form method="post">
                    <li><input class='search-nav' type="text" name="search_val" placeholder="Search"></li>
                    <button type="submit" class="search-nav searchbtn" name="search">Search</button>
                </form>
                <?php

                if (isset($_POST['search'])) {
                    $search_res = $_POST['search_val'];
                    $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE username = '$search_res';");
                    if (mysqli_num_rows($search) == 0) {
                        $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE Fname = '$search_res';");
                        if (mysqli_num_rows($search) == 0) {
                            $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE Lname = '$search_res';");
                            if (mysqli_num_rows($search) == 0) {
                                $pieces = explode(" ", $search_res);
                                if ($pieces[1] = !null);
                                $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE Fname = '$pieces[0]' AND Lname = '$pieces[1]';");
                                if (mysqli_num_rows($search) == 0) {
                                    echo ('<h2>There Are No Results</h2>');
                                }
                            }
                        }
                    }
                    if (mysqli_num_rows($search) > 0) {
                        $counter = 0;
                        while ($row = mysqli_fetch_row($search)) {
                            echo ('<section class = search-navbar>');
                            if (empty($row[0])) {
                                echo '<img class = "profile-pic" alt = "This is a placeholder image for the profile picture" height="50" width="50" src = "../Pictures/null.png" />';
                            } else {
                                echo '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row[0]) . '" height="50" width="50" class="img-thumnail" />';
                            }
                            echo ("<li class = left>$row[1]</li>");
                            echo ("<li class = left>$row[2] </li>");
                            if ($row[3] == $_SESSION['username']) {
                                echo ("<li><a  name = friend-val value = $counter class = search-user href = 'profile.php'>$row[3]</a></li>");
                            }
                            else {
                                echo ("<li><a  name = friend-val value = $counter class = search-user href = 'friend-profile.php?friend=$row[3]'>$row[3]</a></li>");
                            }
                            echo ('</section>');
                            $counter += 1;

                        }
                    }

                        
                ?>
            </ul>
            <hr>
        </nav>
    </header>


    <div class="container">

        <br>
        <h2>Create a Post</h2>
        <form method="post" enctype='multipart/form-data'>
            <input class="pub-title" type="text" name="title" placeholder="Title...">
            <textarea class="pub-content" placeholder="Content of the Blog" cols="40" rows="10"
                name="content"></textarea>
            <input class="img-up" type="file" name="image" id="image">
            <input type="submit" name="submit" class="btn btn-info">

        </form>
        <table>



        </table>
        <?php

        if (isset($_POST['submit'])) {
            $image = $_FILES['image'];
            if (empty($_FILES["image"]["tmp_name"])) {
                echo ('');
            }
            if (!empty($_FILES["image"]["tmp_name"])) {
                $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            }
            $content = $_POST['content'];
            $title = $_POST['title'];
            if (!empty($content) && !empty($title)) {
                if (!empty($file)) {
                    $query = "INSERT INTO user_blog (blog_pic, content, blog_owner, title) VALUES ('{$file}', '{$content}', '{$email}', '{$title}')";
                    mysqli_query($conn, $query);
                } else {
                    $query = "INSERT INTO user_blog (content, blog_owner, title) VALUES ('{$content}', '{$email}', '{$title}')";
                    mysqli_query($conn, $query);
                }
            } else {
                if (empty($content) && empty($title)) {
                    echo "<h2>Please enter the Title and the Content?<h2>";
                } else if (empty($content)) {
                    echo "<h2>Please enter the Content?<h2>";
                } else {
                    echo "<h2>Please enter the Title?<h2>";
                }
            }
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
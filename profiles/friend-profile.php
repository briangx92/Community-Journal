<?php
include '../db/db.php';
require '../include/login.php';
$email = $_SESSION['email'];
$_GLOBALS['email'] = $email;

$friend = $_GET['friend'];
@$host = $_SERVER['QUERY_STRING'];

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

if (isset($_POST["upload"])) {
    $image = $_FILES['image'];
    if (empty($_FILES["image"]["tmp_name"])) {
        echo ('');
    } else {
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $query = "UPDATE users SET profile_pic = '$file' WHERE email= '" . $host . "'";
        mysqli_query($conn, $query);
    }
}

if (isset($_POST['submit9'])) {
    $headline_set = $_POST['headline_set'];
    if (!empty($headline_set)) {
        $headline = "UPDATE users SET headline = '$headline_set' WHERE email= '" . $host . "'";
        $results = mysqli_query($conn, $headline);
    }
}

if (isset($_POST['submit'])) {
    if (!empty($friend)) {
        @$query_request = "INSERT INTO friends (receiver, sender, status) VALUES ('$friend','{$email}', '3');";
        mysqli_query($conn, $query_request);
    }
}

?>

<html>

<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
</head>
<header>
    <!-- Header Nav -->
    <nav>
        <ul>
            <a href="dashboard.php"><img class="img-link" src="../Pictures/logo.png"
                    alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
            <li><a href="../views/messages.php">Messages</a></li>
            <li><a href="public.php">Public</a></li>
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
                        echo ("<li><a  name = friend-val value = $counter class = search-user href = 'friend-profile.php?friend=$row[3]'>$row[3]</a></li>");
                        echo ('</section>');
                        $counter += 1;
                    }
                }
            }
            ?>
        </ul>
    </nav>
</header>
<hr>

<body>
    <section>
        <!-- Profile pic -->
        <article class="profile-sec">

            <?php
            $query = "SELECT profile_pic FROM users WHERE username= '$friend'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_row($result)) {
                if (empty($row[0])) {
                    echo '<img  class = "profile-pic" alt = "This is a placeholder image for the profile picture" height="200" width="200" src = "../Pictures/null.png"/>';
                } else {
                    echo '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row[0]) . '" height="200" width="200" class="img-thumnail" />';
                }
            }

            ?>


            <?php
            $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE username= '$friend'");
            $result = mysqli_query($conn, $name);
            if ($result) {
                while ($row = mysqli_fetch_row($result)) {
                    echo "<section class = work>";
                    echo "<p>Name: $row[0]</p>";
                    echo "<p>Country: $row[1]</p>";
                    echo "</section>";
                    echo "<section class = work>";
                    echo "<p>Username: $row[2]</p>";
                    echo "</section>";
                    echo "<section class = work2>";
                    echo "<p>Headline: $row[3]</p>";
                    echo "</section>";
                }
            }

            ?>


        </article>
        <article>

            <?php
            $query = "SELECT status FROM friends WHERE sender = '{$email}' AND receiver = '{$friend}' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                echo '
                <form method="post">
                    <input type="submit" name="submit" value="Add Friend" >
                </form>
                ';
            } else {
                while ($row = mysqli_fetch_row($result)) {
                    $status = $row[0];
                    if ($row[0] == 3) {
                        echo '<h2>Friend Request Sent</h2>';
                    } else if ($row[0] == 2) {
                        echo '<h2>Friend Request Denied</h2>';
                    } else if ($row[0] == 1) {
                        echo '<h2>You are Friends</h2>';
                    }
                }
            }



            ?>
            <?php
            $friend_list = "SELECT * FROM friends f JOIN users u ON u.email = f.receiver WHERE sender = '{$friend}' AND status = '1';";
            $result = mysqli_query($conn, $friend_list);
            if (mysqli_num_rows($result) == 0) {
                echo '<h1>Friends list:</h1>';
                echo 'They have no friends yet';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['receiver'] != $email) {
                        echo '<h1>Friends list:</h1>';
                        echo "<p>{$row['Fname']} {$row['Lname']}</p>";
                        echo "<br>";
                        echo '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50" class="img-thumnail" />';
                        echo "<br>";
                    }
                }
            }

            ?>
            </select>

        </article>
    </section>


    <br>
    <section>
        <article>
            <h1>Personal Blogs</h1>
            <?php
            $blog_query = "SELECT * FROM user_blog b JOIN users u ON b.blog_owner = u.email WHERE b.blog_owner = '{$host}'; ";
            $result = mysqli_query($conn, $blog_query);
            if (!empty($result)) {
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<p><b>{$row['Fname']} {$row['Lname']}</b></p>";
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';

                    echo "<p><b><i>{$row['title']}</i></b></p>";
                    echo "<p>{$row['dates']}</p>";
                    echo "<p>{$row['content']}</p>";
                    echo '<p>' . '<img src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="150" width="150"></p>';
                    echo "</tr>";
                }
            }

            ?>


        </article>
    </section>
</body>
<hr>
<!-- Footer -->
<footer class='login-footer'>
    <ul>
        <li>Phone: 717-555-5555</li>
        <li>Email: CommunityJournal@gmail.com</li>
        <li>Fax: 171-123-4567</li>
    </ul>
</footer>

</html>
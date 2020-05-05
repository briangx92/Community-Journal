<?php
include '../db/db.php';
require '../include/login.php';

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
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <!-- Header Nav -->
        <nav>
            <ul>
                <a href="dashboard.php"><img class="img-link" src="../Pictures/logo.png"
                        alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
                <li><a href="../views/messages.php">Messages</a></li>
                <li><a href="public.php">Public</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li class = 'unread'>
                    <!-- Notifications -->
                    <?php
                    $query = "SELECT COUNT(msg_status) AS count FROM users_chat WHERE reciever_username = '" . $_SESSION['username'] . "' AND msg_status = 'unread'";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        $something = mysqli_fetch_row($result);
                        echo "Unread messages: {$something[0]}";
                    }
                    ?>
                </li>
                <form method="post" class="logout-nav">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
                <form method="post">
                    <li><input class='search-nav' type="text" name="search_val" placeholder="Search"></li>
                    <button type="submit" class="search-nav searchbtn" name="search-bar">Search</button>
                </form>

                <?php

                if (isset($_POST['search_val'])) {
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
            }
                ?>

            </ul>
        </nav>
        <hr>
    </header>

    <article class="search">
            <?php
                $user = "SELECT * FROM users JOIN friends ON users.email = friends.sender WHERE username!='$_SESSION[username]' AND status = 1 AND receiver = '$_SESSION[username]'";
                
                $run_user = mysqli_query($conn,$user);

                if (mysqli_num_rows($run_user)==0) {
                    echo '<h2 style="color:red;text-align:center;">You have no friends at the moment so you can not search</h2>';
                }
                else {
                    echo '
                    <h2>Search for Different Blogs</h2>
                    <form action="" method="post">
                        <label class = "search-label2">Name</label>
                        <input class = "search-label" type="checkbox" name="filter[]" value="A">
                        <label class = "search-label2">Title</label>
                        <input class = "search-label" type="checkbox" name="filter[]" value="B">
                        <label class = "search-label2">Content</label>
                        <input class = "search-label" type="checkbox" name="filter[]" value="C">
                        <input class = "blog-search" type="text" name="search_text" placeholder="Search here...">

                        <input class = "blog-submit" type="submit" name="search">

                    </form>';
                }
            ?>
              </article>


        <?php

        $submit = isset($_POST['search']);
        @$search_text = $_POST['search_text'];


        function IsChecked($chkname, $value, $submit, $search_text)
        {
            $submit = isset($_POST['search']);
            @$search_text = $_POST['search_text'];

            if (!empty($_POST[$chkname])) {
                foreach ($_POST[$chkname] as $chkval) {
                    if ($chkval == $value) {
                        return true;
                    }
                }
            }
            return false;
        }

        if (IsChecked('filter', 'A', $submit, $search_text)) {

            if ($submit) {

                $filter_query = "SELECT * FROM users u JOIN user_blog b ON u.email = b.blog_owner WHERE blog_owner LIKE '%{$search_text}%'";
                $result = mysqli_query($conn, $filter_query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class = 'profile-feed'>";
                        echo '<img class = "feed-pic" src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';
                        echo "<p class = 'name'><b>{$row['Fname']} {$row['Lname']}</b></p>";
                        echo "<p class = 'title'><b><i>{$row['title']}</i></b></p>";

                        echo "<p class = 'date'>{$row['dates']}</p>";
                        echo "<p class = 'content'>{$row['content']}</p>";
                        if (!empty($row['blog_pic'])) {
                            echo '<p>' . '<img class = "blogpropic" src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="500" width="500"></p>';
                        }
                        echo "</tr>";
                        echo "</div>";
                    }
                }
                else {
                    echo '<h2>There are no results</h2>';
                }
            }
        }

        if (IsChecked('filter', 'B', $submit, $search_text)) {
            if ($submit) {
                $filter_query = "SELECT * FROM user_blog ub JOIN users u ON ub.blog_owner = u.email WHERE title LIKE '%{$search_text}%';";
                $result = mysqli_query($conn, $filter_query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class = 'profile-feed'>";
                        echo '<img class = "feed-pic" src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';
                        echo "<p class = 'name'><b>{$row['Fname']} {$row['Lname']}</b></p>";
                        echo "<p class = 'title'><b><i>{$row['title']}</i></b></p>";

                        echo "<p class = 'date'>{$row['dates']}</p>";
                        echo "<p class = 'content'>{$row['content']}</p>";
                        if (!empty($row['blog_pic'])) {
                            echo '<p>' . '<img class = "blogpropic" src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="500" width="500"></p>';
                        }
                        echo "</tr>";
                        echo "</div>";
                    }
                }
                else {
                    echo '<h2>There are no results</h2>';
                }
            }
        }
        if (IsChecked('filter', 'C', $submit, $search_text)) {

            if ($submit) {
                $filter_query = "SELECT * FROM user_blog ub JOIN users u ON ub.blog_owner = u.email WHERE content LIKE '%{$search_text}%';";
                $result = mysqli_query($conn, $filter_query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class = 'profile-feed'>";
                        echo '<img class = "feed-pic" src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';
                        echo "<p class = 'name'><b>{$row['Fname']} {$row['Lname']}</b></p>";
                        echo "<p class = 'title'><b><i>{$row['title']}</i></b></p>";

                        echo "<p class = 'date'>{$row['dates']}</p>";
                        echo "<p class = 'content'>{$row['content']}</p>";
                        if (!empty($row['blog_pic'])) {
                            echo '<p>' . '<img class = "blogpropic" src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="500" width="500"></p>';
                        }
                        echo "</tr>";
                        echo "</div>";
                    }
                }
                else {
                    echo '<h2>There are no results</h2>';
                }
            }
        }

        ?>
                <article>

            <!-- Most Recent List -->
            <h2 class = 'clear-fix'>List</h2>
            <form action="dashboard.php" method="post">
                <input type="text" name="content" placeholder="Enter a list">
                <?php
                $listcount_query = "SELECT COUNT(content) FROM recent_list WHERE list_owner = '{$email}';";

                $result = mysqli_query($conn, $listcount_query);
                if (mysqli_num_rows($result) > 0) {
                    echo '<input type="text" name="delete_list" placeholder="Enter ID to delete list">';
                }

                ?>

                <button type="submit" name="submit">Submit</button>

            </form>
            <?php

            if (isset($_POST['submit'])) {
                if (!empty($_POST['content'])) {
                    $query = "INSERT INTO recent_list (content,list_owner) VALUES ('{$_POST['content']}','{$email}');";
                    $results = mysqli_query($conn, $query);
                }
                if (!empty($_POST['delete_list'])) {
                    $delete_query = "DELETE FROM recent_list WHERE list_id = {$_POST['delete_list']} AND list_owner = '{$email}';";
                    $result = mysqli_query($conn, $delete_query);
                }
            }


            ?>

            <?php

            $list_query = "SELECT * FROM `recent_list` WHERE `list_owner` = '{$email}';";

            $result = mysqli_query($conn, $list_query);

            if ($result) {
                $counters = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<table>";
                    echo "<div class='profile-feed'>";
                    echo "<p>$counters . <b>{$row['content']} <br> ID: ({$row['list_id']})</b></p>";
                    echo "<p><b></b></p>";

                    echo "</div>";
                    echo "</table>";
                    $counters += 1;
                }
            }


        ?>
                
        </article>
        <?php
        // Friend lists pending
        $query = "SELECT * FROM users u JOIN friends f ON u.username = receiver WHERE f.receiver = '" . $_SESSION['username'] . "' AND status = '3';";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sender = $row['sender'];
                // Fetching friends profile picture to display next to name
                $friend_info = "SELECT * FROM users WHERE email = '{$sender}'";
                $result2 = mysqli_query($conn, $friend_info);
                $row2 = mysqli_fetch_assoc($result2);
                echo "
                    <form method='post' action =''>
                        <input class = 'left5'type='radio' name='radio' value='{$sender}'>
                        <li class = 'left'>{$row2['Fname']}</li> <li class = 'left'>{$row2['Lname']}</li>" . '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row2['profile_pic']) . '" height="50" width="50">
                        <input type="submit" name="accept" value="Accept">
                        <input type="submit" name="reject" value="Reject">
                    </form>';
            }
        }

        ?>
        <?php
        // STATUS 1 = ACCEPT
        if (isset($_POST['accept'])) {
            if (isset($_POST['radio'])) {
                $add_friend = "UPDATE friends SET status = 1 WHERE receiver = '" . $_SESSION['username'] . "' AND sender = '{$sender}';";
                mysqli_query($conn, $add_friend);
                echo '<script>window.location="http://localhost/Community-Journal/profiles/dashboard.php"</script>';
            }
        }
        // STATUS 2 = REJECT
        // After rejection the request becomes deleted from the DB
        if (isset($_POST['reject'])) {
            if (isset($_POST['radio'])) {
                $reject_friend = "UPDATE friends SET status = 2 WHERE receiver = '" . $_SESSION['username'] . "' AND sender = '{$sender}';";
                mysqli_query($conn, $reject_friend);
                echo '<script>window.location="http://localhost/Community-Journal/profiles/dashboard.php"</script>';
            }
        }
        ?>




        <hr>
        <section>
            <article>

                <h2 class = 'clear-fix'>Blog Feed</h2>

                <?php
                $blog_query = "SELECT * FROM user_blog LEFT JOIN users ON email = blog_owner WHERE blog_owner = '{$email}' ORDER BY blog_id DESC LIMIT 1";

                $result = mysqli_query($conn, $blog_query);

                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<div class = 'profile-feed'>";
                        echo '<img class = "feed-pic" src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';
                        echo "<p class = 'name'><b>{$row['Fname']} {$row['Lname']}</b></p>";

                        echo "<p class = 'title'><b><i>{$row['title']}</i></b></p>";
                        echo "<p class = 'date'>{$row['dates']}</p>";
                        echo "<p class = 'content'>{$row['content']}</p>";
                        if (!empty($row['blog_pic'])) {
                            echo '<p>' . '<img class = "blogpropic" src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="500" width="500"></p>';
                        }
                        echo "</tr>";
                        echo "</div>";
                    }
                }
                ?>
                <?php
                $friend_blog_query = "SELECT * FROM users u JOIN user_blog b ON u.email = b.blog_owner JOIN friends f ON b.blog_owner = f.sender WHERE username!='$_SESSION[username]' AND status = 1 AND receiver = '$_SESSION[username]' ORDER BY blog_id DESC";

                $result = mysqli_query($conn, $friend_blog_query);
                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<div class = 'profile-feed'>";
                        echo '<img class = "feed-pic" src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';
                        echo "<p class = 'name'><b>{$row['Fname']} {$row['Lname']}</b></p>";
                        echo "<p class = 'title'><b><i>{$row['title']}</i></b></p>";

                        echo "<p class = 'date'>{$row['dates']}</p>";
                        echo "<p class = 'content'>{$row['content']}</p>";
                        if (!empty($row['blog_pic'])) {
                            echo '<p>' . '<img class = "blogpropic" src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="500" width="500"></p>';
                        }
                        echo "</tr>";
                        echo "</div>";
                    }
                }

                ?>


            </article>

        </section>


    </body>
    <!-- Footer -->
    <footer class='login-footer'>
        <ul>
            <li>Phone: 717-555-5555</li>
            <li>Email: CommunityJournal@gmail.com</li>
            <li>Fax: 171-123-4567</li>
        </ul>
    </footer>

</html>
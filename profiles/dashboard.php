<?php
include '../db/db.php';
require '../include/login.php';

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
                <form method="post" class="logout-nav">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
                <form method="post">
                    <li><input class='search-nav' type="text" name="search_val" placeholder="Search"></li>
                    <button type="submit" class="search-nav searchbtn" name="search-bar">Search</button>
                </form>

                <?php

            if (isset($_POST['search-bar'])) {
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

    <body>
        <article>
            <!-- Most Recent List -->
            <label for="list">List</label>
            <table name='list'>
                <?php

                $list_query = "SELECT content FROM `recent_list` WHERE `list_owner` = '{$email}' LIMIT 5;";

                $result = mysqli_query($conn, $list_query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<table>";
                        echo "<p><b>{$row['content']}</b></p>";
                        echo "</table>";
                    }
                }


                ?>
                <hr>
        </article>
        <form action="dashboard.php" method="post">
            <?php
            // Friend lists pending
            $query = "SELECT * FROM users u JOIN friends f ON u.email = receiver WHERE f.receiver = '{$email}' AND status = '3';";
            $result = mysqli_query($conn, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sender = $row['sender'];
                    // Fetching friends profile picture to display next to name
                    $friend_info = "SELECT * FROM users WHERE email = '{$sender}'";
                    $result2 = mysqli_query($conn, $friend_info);
                    $row2 = mysqli_fetch_assoc($result2);
                    echo "<input type='radio' name='radio' value='{$sender}'>{$row2['Fname']} {$row2['Lname']}" . '<img src="data:image/jpeg;base64,' . base64_encode($row2['profile_pic']) . '" height="50" width="50"">';
                }
            }

            ?>

            <input type="submit" name="accept" value="Accept">
            <input type="submit" name="reject" value="Reject">
        </form>
        <?php
        // STATUS 1 = ACCEPT
        if (isset($_POST['accept'])) {
            if (isset($_POST['radio'])) {
                $query = "SELECT * FROM users u JOIN friends f ON u.email = receiver WHERE u.email = '{$email}';";
                $result = mysqli_query($conn, $query);
                if ($result) {

                    $add_friend = "UPDATE friends SET status = 1 WHERE receiver = '{$email}' AND sender = '{$sender}';";
                    mysqli_query($conn, $add_friend);
                }
            }
        }
        // STATUS 2 = REJECT
        // After rejection the request becomes deleted from the DB
        if (isset($_POST['reject'])) {
            if (isset($_POST['radio'])) {
                $query = "SELECT * FROM users u JOIN friends f ON u.email = receiver WHERE u.email = '{$email}';";
                $result = mysqli_query($conn, $query);
                if ($result) {

                    $reject_friend = "UPDATE friends SET status = 2 WHERE receiver = '{$email}' AND sender = '{$sender}';";
                    mysqli_query($conn, $reject_friend);
                    $delete_request = "DELETE FROM friends WHERE receiver = '{$email}' AND sender = '{$sender}';";
                }
            }
        }
        ?>




        <hr>
        <section name=" blog feed">
            <article name="blog">

                <label>Blog Feed</label>

                <?php
                $blog_query = "SELECT * FROM user_blog b LEFT JOIN users u ON u.email = b.blog_owner WHERE b.blog_owner = '{$email}' LIMIT '2';";

                $result = mysqli_query($conn, $blog_query);

                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<p><b>{$row['Fname']} {$row['Lname']}</b></p>";
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';

                        echo "<p><b><i>{$row['title']}</i></b></p>";
                        echo "<p>{$row['dates']}</p>";
                        echo "<p>{$row['content']}</p>";

                        echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="150" width="150"></p>';
                        echo "</tr>";
                    }
                }
                ?>
                <?php
                $friend_blog_query = "SELECT * FROM users u JOIN user_blog b ON u.email = b.blog_owner JOIN friends f ON b.blog_owner = f.sender WHERE status = 1;";

                $result = mysqli_query($conn, $friend_blog_query);

                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<p><b>{$row['Fname']} {$row['Lname']}</b></p>";
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';

                        echo "<p><b><i>{$row['title']}</i></b></p>";
                        echo "<p>{$row['dates']}</p>";
                        echo "<p>{$row['content']}</p>";

                        echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="150" width="150"></p>';
                        echo "</tr>";
                    }
                }

                ?>


            </article>

        </section>
        <article name="search">


            <form action="dashboard.php" method="post">

                <input type="checkbox" name="filter[]" value="A">Name<br>
                <input type="checkbox" name="filter[]" value="B">Title<br>
                <input type="checkbox" name="filter[]" value="C">Content<br>
                <input type="text" name="search_text" placeholder="Search here...">

                <input type="submit" name="search">

            </form>


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
                            echo "<table name='blog_owner'>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo '<th><img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"></th>';
                            echo "<tr>";
                            echo "<td>{$row['blog_owner']}</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    }
                }
            }

            if (IsChecked('filter', 'B', $submit, $search_text)) {

                if ($submit) {
                    $filter_query = "SELECT * FROM user_blog ub JOIN users u ON ub.blog_owner = u.email WHERE title LIKE '%{$search_text}%';";
                    $result = mysqli_query($conn, $filter_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<table name='title'>";
                            echo "<tr>";
                            echo '<th><img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"></th>';
                            echo "<th>Title</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>{$row['title']}</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    }
                }
            }
            if (IsChecked('filter', 'C', $submit, $search_text)) {

                if ($submit) {
                    $filter_query = "SELECT * FROM user_blog ub JOIN users u ON ub.blog_owner = u.email WHERE content LIKE '%{$search_text}%';";
                    $result = mysqli_query($conn, $filter_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<table name='content'>";
                            echo "<tr>";
                            echo '<th><img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"></th>';
                            echo "<br>";
                            echo "<th>Content</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>{$row['content']}</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    }
                }
            }

            ?>

        </article>



        <?php
        // echo "<script>
        // document.getElementById('messages').addEventListener('click', function() {
        //   window.open('../views/messages.php?user_name={$user_name}','_self')
        // });
        // </script>";
        ?>


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
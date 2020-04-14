<?php
include '../db/db.php';
require '../include/login.php';
include '../include/friend_request.php';

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
                <li><input class='search-nav' type="text" name="search" placeholder="Search"></li>
                <form method="post" class="logout-nav">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
            </ul>
        </nav>
    </header>

    <body>
        <article>
            <!-- Most Recent List -->

            <ul>
                <?php


                $list_query = "SELECT content FROM `recent_list` WHERE `list_owner` = '{$email}' LIMIT 5;";

                $result = mysqli_query($conn, $list_query);
                $result_check = mysqli_num_rows($result);

                if ($result_check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>{$row['content']}</li>";
                    }
                }

                ?>
            </ul>
        </article>

        <label for="friendrequests">Friend Requests</label>
        <select id="friendrequests">
            <option>friend 1</option>
            <option>friend 2</option>

        </select>

        <section name="blog feed">
            <article name="blog">

                <label>Blog Feed</label>

                <?php
                $blog_query = "SELECT b.title, b.blogpic, b.Dates, b.content, CONCAT(u.Fname, ' ', u.Lname) AS fullname, u.profile_pic FROM user_blog b LEFT JOIN users u ON u.email = b.blog_owner WHERE b.blog_owner = '{$email}';";

                $result = mysqli_query($conn, $blog_query);
                $result_check = mysqli_num_rows($result);

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<p><b>{$row['fullname']}</b></p>";
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';

                    echo "<p><b><i>{$row['title']}</i></b></p>";
                    echo "<p>{$row['Dates']}</p>";
                    echo "<p>{$row['content']}</p>";
                    echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['blogpic']) . '" height="150" width="150"></p>';
                    echo "</tr>";
                }

                ?>

                </ul>
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
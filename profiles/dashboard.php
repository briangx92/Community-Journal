<?php
include '../db/db.php';
require '../include/login.php';

// Curent Logged in user
// Visible for testing purposes
$email = $_SESSION['email'];
$_GLOBALS['email'] = $email;
echo $email;

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
        <nav>
            <ul>
                <a href="dashboard.php"><img class="img-link" src="../Pictures/logo.png"
                        alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
                <li id="messages"><a>Messages</a></a></li>
                <li><a href="../profiles/personal.php">Personal</a></li>
                <li><a href="../profiles/public.php">Public</a></li>
                <li><input type="text" name="search" placeholder="Search"></li>
                <li><a href="../profiles/profile.php">Profile</a></li>
                <li>
                    <input type="button" onclick="location.href='http://localhost/Community-Journal/views/index.php';"
                        value="Logout">
                </li>
            </ul>
        </nav>
        <hr>
    </header>

    <body>
        <article>
            <!-- Most Recent List -->
            <label>Most Recent List</label>
            <ul>
                <?php

                $list_query = "SELECT content FROM `recent_list` WHERE `list_owner` = '{$email}' LIMIT 5;";

                $result = mysqli_query($conn, $list_query);
                $result_check = mysqli_num_rows($result);

                foreach ($result as $row) {
                    echo "<li>{$row['content']}</li>";
                }

                ?>
            </ul>
        </article>


        <section name="blog feed">
            <article name="blog">

                <label>Blog Feed</label>
                <ul>
                    <?php
                    $blog_query = "SELECT b.title, b.blogpic, b.Dates, b.content, CONCAT(u.Fname, ' ', u.Lname) AS fullname FROM user_blog b LEFT JOIN users u ON u.email = b.blog_owner WHERE b.blog_owner = '{$email}';";

                    $result = mysqli_query($conn, $blog_query);
                    $result_check = mysqli_num_rows($result);

                    foreach ($result as $row) {
                        echo "<li><b>{$row['fullname']}</b></li>
                    <!--<li><img src='#'></li>-->
                    <li><b><i>{$row['title']}</i></b></li>
                    <li>{$row['Dates']}</li>
                    <li>{$row['content']}</li>
                    </ul>
                    ";
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
                <input type="checkbox" name="filter[]" value="D">None<br>
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
                            echo "</tr>";
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
                    $filter_query = "SELECT * FROM user_blog WHERE title LIKE '%{$search_text}';";
                    $result = mysqli_query($conn, $filter_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<table name='title'>";
                            echo "<tr>";
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
                    $filter_query = "SELECT * FROM user_blog WHERE content LIKE '%{$search_text}%';";
                    $result = mysqli_query($conn, $filter_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<table name='content'>";
                            echo "<tr>";
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
            if (IsChecked('filter', 'D', $submit, $search_text)) {

                if ($submit) {
                    $filter_query = "SELECT * FROM user_blog;";
                    $result = mysqli_query($conn, $filter_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<table name='none'>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo "<th>Title</th>";
                            echo "<th>Content</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>{$row['blog_owner']}</td>";
                            echo "<td>{$row['title']}</td>";
                            echo "<td>{$row['content']}</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    }
                }
            }

            ?>

        </article>
        <article name="comment_box">
            <form action="dashboard.php" id="comment_form">
                <input type="submit" name="submit_comment">
            </form>
            <textarea name="comment" form="comment_form">Enter comment...</textarea>

            <?php

            $submit_comment = isset($_POST['submit_comment']);
            // $comment_area = $_POST['comment'];

            ?>
            <table>
                <tr>

                </tr>
            </table>
        </article>


        <?php
        echo "<script>
        document.getElementById('messages').addEventListener('click', function() {
          window.open('../views/messages.php?user_name=$user_name','_self')
        });
        </script>";
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

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
</head>
<header>
    <nav>
        <ul>
            <li><a href="../profiles/dashboard.php"><img src="../Pictures/logo.png"
                        alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
            </li>
            <li><a href="../messages.php">Messages</a></li>
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

            $list_query = "SELECT content FROM `recent_list` WHERE `list_owner` = '{$email}';";

            $result = mysqli_query($conn, $list_query);
            $result_check = mysqli_num_rows($result);

            foreach ($result as $row) {
                echo "<li>{$row['content']}</li>";
            }





            ?>
        </ul>
    </article>


    <section name="blog feed">
        <!-- First blog feed should be recent post from logged in user -->
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





    </section>
    <article name="search">
        <form action="dashboard.php">
            <fieldset>
                <input type="text" name="search" placeholder="Search">
                <label>Filter: </label>
                <select>
                    <option value="1">Name</option>
                    <option value="2">Title</option>
                    <option value="3">Content</option>
                </select>
                <br>
                <button type="submit" name="search">Search</button>

            </fieldset>

        </form>

    </article>
    <article name="comment_box">

    </article>



</body>
<hr>
<!-- Footer -->
<footer>
    <p>Community Journal</p>
    <p>Contact Us: communityjournal@support.com</p>
</footer>

</html>
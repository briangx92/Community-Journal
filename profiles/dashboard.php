<?php
include '../db/db.php';
require '../include/login.php';

$email = $_SESSION['email'];
echo $email;
?>
<html>

<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="styles.css" rel="stylesheet" type="text/css">
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
        <ul>
            <li>recent list 1</li>
            <li>recent list 2</li>
        </ul>
    </article>
    <form action="dashboard.php" method="POST">
        <label for="blogtitle">Blog Title:</label>
        <input type="text" name="blogtitle">
        <p></p>
        <!-- insert bloggers name based from their userid -->
        <input type="text" name="bloggername">
        <p name="date">Date</p>
        <label for="img">Select image</label>
        <input type="file" name="img" id="img" accept="image/*">
        <input type="text" name="blogcontent">
        <button type="submit" name="blog_submit" onclick="location.href='dashboard.php'">Post</button>
    </form>

    <section name="blog feed">
        <!-- First blog feed should be recent post from logged in user -->
        <article name="blog1">
            <?php
            $email = $_SESSION['email'];
            $blog_query = "SELECT b.title, b.blogpic, b.Dates, b.commment, b.content, u.Fname, u.Lname FROM blogfeed AS b LEFT JOIN users AS u ON b.blog_id = u.user_id WHERE u.email = '" . $email . "';";

            $run_query = mysqli_query($conn, $blog_query);
            $row = mysqli_num_rows($run_query);

            if ($row > 0) {
                while ($tables = mysqli_fetch_assoc($run_query)) {
                    echo '<p>' . $tables['title'] . '</p>';
                    echo '<p>' . $tables['Fname'] . ' ' . $tables['Lname'] . '</p>';
                    echo '<p>' . $tables['Dates'] . '</p>';
                    echo '<p>' . $tables['content'] . '</p>';
                    // echo '<img src="' . $tables['blogpic'] . '">';
                }
            }


            // Grab all these from blog_feed and user_id.
            // Might have to create a join table to grab all these


            ?>

        </article>
        <hr>
        <!-- All other blogs come from friends latest 2 post sorted by date from recent to oldest -->
        <?php
        echo "<article name='blog2'>
            <p>Blog Title</p>
            <p>Blogger Name</p>
            <p>Date</p>
            <p>blog stuff here</p>
            <img src='yourphotos/#' alt='blog picture' name='make the name be userid+increment by 1'>
        </article>"
        ?>

    </section>
    <article name="search">
        <form action="dashboard.php">
            <input type="text" name="search" placeholder="Filter/Search">
            <button type="submit">Search</button>
        </form>
    </article>
    <article name="comment_box">
        <p>comments</p>

    </article>



</body>
<hr>
<!-- Footer -->
<footer>
    <p>Community Journal</p>
    <p>Contact Us: communityjournal@support.com</p>
</footer>

</html>
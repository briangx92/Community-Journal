<?php
include '../db/db.php';
require '../include/login.php';
// URL stuff that i could possibly use later on
// preg_match("/php/", "{$_SERVER['REQUEST_URI']}", $matches);
// $last_word = $matches[0];
// echo $last_word;



if (isset($_POST['logout'])) {
    $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE email= '" . $_SESSION['email'] . "'");
    session_destroy();
    header("location: ../");
}

$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if ($host == 'http://localhost/Community-Journal/profiles/friend-profile.php') {
    $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE username='users.username'");
    mysqli_query($conn, $name);
}
$friend = $_SERVER['QUERY_STRING'];
$friend_profile = $_GET['friend'];
?>

<html>

<head>
    <title>Friend Profile</title>
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
            <a href='profile.php' class='backarrow'> ⇚</a>
            <form method="post" class="logout-nav">
                <button type="submit" class="btn" name="logout">Logout</button>
            </form>
        </ul>
    </nav>
</header>
<hr>

<body>

    <section>


        <article class="profile-sec">


            <?php
            // Profile Picture
            $query = "SELECT profile_pic FROM users WHERE username= '{$friend_profile}'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_row($result)) {
                if (empty($row[0])) {
                    echo '<img  class = "profile-pic" alt = "This is a placeholder image for the profile picture" height="200" width="200" src = "../Pictures/null.png"/>';
                } else {
                    echo '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row[0]) . '" height="200" width="200" class="img-thumnail" />';
                }
            }



            $name = "SELECT * FROM users WHERE username = '{$friend_profile}'";
            $result = mysqli_query($conn, $name);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<section class = work>";
                    echo "<p>Name: {$row['Fname']} {$row['Lname']}</p>";
                    echo "<p>Country: {$row['country']}</p>";
                    echo "</section>";
                    echo "<section class = work>";
                    echo "<p>Username: {$row['username']}</p>";
                    echo "</section>";
                    echo "<section class = work2>";
                    echo "<p>Headline: {$row['headline']}</p>";
                    echo "</section>";
                }
            }
            ?>

            <?php
            // STATUS CODE 3 = PENDING REQUEST
            $logged_user = $_SESSION['email'];
            $friend_request = isset($_POST['3']);

            if ($friend_request) {
                $query_request = "INSERT INTO friends (receiver, sender, status) VALUES ('{$friend}','{$logged_user}', '3');";
                mysqli_query($conn, $query_request);
                $hidden = "hidden";
            }

            ?>
            <form action="friend-profile.php" method="post">
                <input type="submit" name="3" value="Add Friend">
            </form>



            <label>Blog Feed</label>

            <?php
            $blog_query = "SELECT b.title, b.blog_pic, b.dates, b.content, CONCAT(u.Fname, ' ', u.Lname) AS fullname, u.profile_pic FROM user_blog b LEFT JOIN users u ON u.email = b.blog_owner WHERE b.blog_owner = '{$friend}';";

            $result = mysqli_query($conn, $blog_query);
            $result_check = mysqli_fetch_assoc($result);

            if (!empty($result)) {
                foreach ($result as $row) {
                    echo "<table>";
                    echo "<p><b>{$row['fullname']}</b></p>";
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_pic']) . '" height="50" width="50"">';

                    echo "<p><b><i>{$row['title']}</i></b></p>";
                    echo "<p>{$row['dates']}</p>";
                    echo "<p>{$row['content']}</p>";
                    echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['blog_pic']) . '" height="150" width="150"></p>';
                    echo "</table>";
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
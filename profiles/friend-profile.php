<?php
    include '../db/db.php';
    require '../include/login.php';

    if (isset($_POST['logout'])) {
        $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
        session_destroy();
        header("location: ../");
    }

    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if($host == 'http://localhost/Community-Journal/profiles/friend-profile.php') {
        $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE username='row[3]'"); 
        mysqli_query($conn, $name);
        
    } 

    $friend = $_GET['friend'];
?>

<html>
<head>
    <title>Friend Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="../Pictures/logo.png" >
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
</head>
    <header>
        <!-- Header Nav -->
        <nav>
            <ul>
                <a href="dashboard.php"><img class = "img-link" src="../Pictures/logo.png" alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
                <li><a href="../views/messages.php">Messages</a></li>
                <li><a href="public.php">Public</a></li>
                <a href='profile.php' class='backarrow'> ⇚</a>
                <form method="post" class = "logout-nav">
                    <button type="submit" class="btn" name = "logout">Logout</button>
                </form>
            </ul>
        </nav>
    </header>
    <hr>

<body>

    <section>

        <!-- Profile pic -->
        <article class = "profile-sec">


        <?php
        $query = "SELECT profile_pic FROM users WHERE username= '$friend'";
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_row($result)){
            if (empty($row[0])) {
                echo '<img  class = "profile-pic" alt = "This is a placeholder image for the profile picture" height="200" width="200" src = "../Pictures/logo.png" />';
            } else {
                echo '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row[0]) . '" height="200" width="200" class="img-thumnail" />';
            }
        }

        ?>
            <?php
            $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE username= '$friend'"); 
            $result = mysqli_query($conn, $name);
            if($result) {
                while($row = mysqli_fetch_row($result)) {
                    echo "<section class = work>";
                    echo "<p>Name: $row[0]</p>";
                    echo "<p>Country: $row[1]</p>";
                    echo "</section>";
                    echo "<section class = work>";
                    echo "<p>Username: $row[2]</p>";
                    echo "
                    <article>
                        <label for='friendrequests'>Friend Requests</label>
                        <select id='friendrequests'>
                            <option value='friend1'>friend 1</option>
                            <option value='friend2'>friend 2</option>

                        </select>
                    </article>
                    ";
                    echo "</section>";
                    echo "<section class = work2>";
                    echo "<p>Headline: $row[3]</p>";
                    echo "</section>";
                }
            }

            ?>

</body>
<hr>
<!-- Footer -->
<footer class = 'login-footer'>  <ul>
    <li>Phone: 717-555-5555</li>
    <li>Email: CommunityJournal@gmail.com</li>
    <li>Fax: 171-123-4567</li>
  </ul>
</footer>

</html>
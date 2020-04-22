<?php
    include '../db/db.php';
    require '../include/login.php';

    if (isset($_POST['logout'])) {
        $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
        session_destroy();
        header("location: ../");
    }

    if (isset($_POST["upload"])) {
        $image = $_FILES['image'];
        if (empty($_FILES["image"]["tmp_name"])) {
            echo('');
        } else {
            $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            $query = "UPDATE users SET profile_pic = '$file' WHERE username= '" . $_SESSION['user_name'] . "'";
            mysqli_query($conn, $query);
        }
    }

    if (isset($_POST['submit9'])) {
        $headline_set = $_POST['headline_set'];
        $headline = "UPDATE users SET headline = '$headline_set' WHERE username= '" . $_SESSION['user_name'] . "'";
        $results = mysqli_query($conn, $headline);
    }

?>

<html>

<head>
    <title>Profile</title>
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
                <form method="post" class = "logout-nav">
                    <button type="submit" class="btn" name = "logout">Logout</button>
                </form>
                <form method="post">
                    <li><input class ='search-nav' type="text" name="search_val" placeholder="Search"></li>
                    <button type="submit" class="search-nav searchbtn" name = "search">Search</button>
                </form>
                <?php

                    if (isset($_POST['search'])) {
                        $search_res = $_POST['search_val'];
                        $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE username = '$search_res';");
                        if (mysqli_num_rows($search)==0) {
                            $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE Fname = '$search_res';");
                            if (mysqli_num_rows($search)==0) {
                                $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE Lname = '$search_res';");
                                if (mysqli_num_rows($search)==0) {
                                    $pieces = explode(" ", $search_res);
                                    if ($pieces[1] = !null);
                                        $search = mysqli_query($conn, "SELECT profile_pic, Fname, Lname, username FROM users WHERE Fname = '$pieces[0]' AND Lname = '$pieces[1]';"); 
                                    if (mysqli_num_rows($search)==0) {
                                        echo('<h2>There Are No Results</h2>');
                                    }
                                }
                            }
                        }
                        if (mysqli_num_rows($search)>0) {
                            $counter = 0;
                            while($row=mysqli_fetch_row($search)){
                                echo ('<section class = search-navbar>');
                                if (empty($row[0])) {
                                    echo '<img class = "profile-pic" alt = "This is a placeholder image for the profile picture" height="50" width="50" src = "../Pictures/logo.png" />';
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
        <article class = "profile-sec">

        <?php
        $query = "SELECT profile_pic FROM users WHERE username= '" . $_SESSION['user_name'] . "'";
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_row($result)){
            if (empty($row[0])) {
                echo '<img  class = "profile-pic" alt = "This is a placeholder image for the profile picture" height="200" width="200" src = "../Pictures/logo.png" />';
                echo '<label for="Image">Stock Image for Profile Picture</label>';
            } else {
                echo '<img class = "profile-pic" src="data:image/jpeg;base64,' . base64_encode($row[0]) . '" height="200" width="200" class="img-thumnail" />';
            }
        }

        ?>

        <?php
            $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE ");
            $result = mysqli_query($conn, $name);
            if (isset($_SESSION['user_name'])){
                echo "
                <form class = 'profile-form' method='post' enctype='multipart/form-data'>
                    <input type='file' name='image' id='image'>
                    <input type='submit' name='upload' id='submit' value='Upload' class='btn btn-info'>
                </form>";
            }
        ?>
            <?php
            $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE username= '" . $_SESSION['user_name'] . "'"); 
            $result = mysqli_query($conn, $name);
            if($result) {
                while($row = mysqli_fetch_row($result)) {
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
            <form method="post">
                <input class ='search-nav' type="text" name="headline_set" placeholder="Headline">
                <button type="submit" class="search-nav searchbtn" name = "submit9">Submit</button>
            </form>

        </article>
        <article>
            <label for="friendrequests">Friend Requests</label>
            <select id="friendrequests">
                <option value="friend1">friend 1</option>
                <option value="friend2">friend 2</option>

            </select>

        </article>
    </section>
    <section>
        <article>
            <h1>Personal Blogs</h1>
            <ul>
                <li>blog 1</li>
                <li>blog 2</li>
            </ul>
        </article>
    </section>
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
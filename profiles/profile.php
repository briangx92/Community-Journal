<?php
    include '../db/db.php';
    require '../include/login.php';
    var_dump($_SESSION);

    if (isset($_POST['logout'])) {
        $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
        session_destroy();
        header("location: ../");
    }

    if (isset($_POST["upload"])) {
        $image = $_FILES['image'];
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $query = "UPDATE users SET profile_pic = '$file' WHERE username= '" . $_SESSION['user_name'] . "'";
        mysqli_query($conn, $query);
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
                <li><a href="personal.php">Personal</a></li>
                <li><a href="public.php">Public</a></li>
                <li><input class ='search-nav' type="text" name="search" placeholder="Search"></li>
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
        <article>

        <br />
        <?php
        $query = "SELECT profile_pic FROM users WHERE username= '" . $_SESSION['user_name'] . "'";
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_row($result)){
            // echo($row[0]);
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row[0]) . '" height="200" width="200" class="img-thumnail" />';
        }

        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="submit" name="upload" id="submit" value="Upload" class="btn btn-info">
        </form>
    
            <?php
            $name = ("SELECT users.Fname, users.country, users.username, users.headline FROM users WHERE username= '" . $_SESSION['user_name'] . "'"); 
            $result = mysqli_query($conn, $name);
            if($result) {
                while($row = mysqli_fetch_row($result)) {
                    echo "<p>$row[0]</p>";
                    echo "<p>$row[1]</p>";
                    echo "<p>$row[2]</p>";
                    echo "<p>$row[3]</p>";
                }
            }

            ?>
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
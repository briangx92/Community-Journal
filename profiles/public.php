<?php

require('../include/login.php');
include('../db/db.php');

if (isset($_POST['logout'])) {
    $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
    session_destroy();
    header("location: ../views");
}

if (isset($_POST["insert"])) {
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $query = "INSERT INTO user_blog (blogpic) VALUES ('$file')";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Image Inserted into Database")</script>';
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Public Page</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <a href="dashboard.php"><img class="img-link" src="../Pictures/logo.png"
                        alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
                <li><a href="personal.php">Personal</a></li>
                <li><a href="../messages.php">Messages</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><input class='search-nav' type="text" name="search" placeholder="Search"></li>
                <form method='post' class="logout-nav">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
            </ul>
        </nav>
    </header>

    <h2>Create a Post</h2>

    <input type="text" placeholder="Title...">

    <textarea placeholder="What's on your mind?" cols="40" rows="10"></textarea>
    <div class="container" style="width:500px;">
        <br />
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image" />
            <br />
            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
        </form>
        <?php
        $query = "SELECT * FROM user_blog ORDER BY blog_id DESC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '  
                          <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['blogpic']) . '" height="200" width="200" class="img-thumnail" />  
                               </td>  
                          </tr>  
                     ';
        }
        ?>
        </table>
    </div>
    <footer>
        <ul>
            <li>Phone: 717-555-5555</li>
            <li>Email: CommunityJournal@gmail.com</li>
            <li>Fax: 171-123-4567</li>
        </ul>
    </footer>
</body>

</html>
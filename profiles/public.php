<?php

session_start();

    if(isset($_POST['logout'])) {
        $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE username= '" . $_SESSION['user_name'] . "'");
        session_destroy();
        header("location: ../views");
    }
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
    <title>Public Page</title>
</head>
    <body>
        <header>
            <nav>
                <ul>
                    <a href="dashboard.php"><img class = "img-link" src="../Pictures/logo.png" alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>  
                    <li><a href="personal.php">Personal</a></li>
                    <li><a href="../messages.php">Messages</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><input class ='search-nav' type="text" name="search" placeholder="Search"></li>
                    <form method='post' class = "logout-nav">
                        <button type="submit" class="btn" name = "logout">Logout</button>
                    </form>
                </ul>
            </nav>
        </header>

        <h2>Create a Post</h2>

        <input type="text" placeholder="Title">
        <input type="blob" placeholder="Picture">
        <button>Attach</button>
        <textarea name="This is your Post Area" cols="200" rows="30"></textarea>

        <input type="text" name="searchblogs" placeholder="Search Blogs">

        <input type="submit" value="Post">

        <footer class ='login-footer'>                 
            <ul>
                <li>Phone: 717-555-5555</li>
                <li>Email: CommunityJournal@gmail.com</li>
                <li>Fax: 171-123-4567</li>
            </ul>
        </footer>
    </body>
</html>
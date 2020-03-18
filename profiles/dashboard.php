<html>

<head>
    <title></title>
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
                <form action="dashboard.php" class="logout">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
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
    <section name="blog feed">
        <article name="blog1">
            <!-- <img src="yourphotos/#" name="picture" alt="blog_pic"> -->
            <p>Blog Title</p>
            <p>Blogger Name</p>
            <p>Date</p>
            <p>blog stuff here</p>
        </article>
        <hr>
        <article name="blog2">
            <!-- <img src="yourphotos/#" name="picture" alt="blog_pic"> -->
            <p>Blog Title</p>
            <p>Blogger Name</p>
            <p>Date</p>
            <p>blog stuff here</p>
        </article>

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
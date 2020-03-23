<!DOCTYPE html>
<html lang="en">

<head>
    <title>Personal Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/style.css" rel="stylesheet">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<header>
    <nav>
        <ul>
            <li><a href="../profiles/dashboard.php"><img src="../Pictures/logo.png"
                        alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
            </li>
            <li><a href="../profiles/profile.php">Profile</a></li>
            <li><a href="../messages.php">Messages</a></li>
            <li><input type="text" name="search" placeholder="Search"></li>
            <li><a href="../profiles/public.php">Public</a></li>
            <li>
                <form action="dashboard.php" class="logout">
                    <button type="submit" class="btn" name="logout">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<hr>


<body>
    <!-- Blog Post -->
    <section>
        <button type="submit" name="create_post" alt="create_post">Create Post</button>
        <p>text here</p>
    </section>
    <!-- Draft of Blogs -->
    <section>
        <article>


            <p>Drafts</p>
            <hr>
            <ul>
                <li>List 1</li>
                <ul>
                    <li>todo 1</li>
                    <li>todo 2</li>
                </ul>
                <li>List 2</li>
                <ul>
                    <li>todo 1</li>
                    <li>todo 2</li>
                </ul>
            </ul>
        </article>
        <!-- Blog List -->
        <article>


            <p>Draft of blogs</p>
            <ul>
                <li>blog 1</li>
                <li>blog 2</li>
            </ul>

        </article>
    </section>



</body>
<hr>
<!-- Footer -->
<footer>
    <p>Community Journal</p>
    <p>Contact Us: communityjournal@support.com</p>
</footer>

</html>
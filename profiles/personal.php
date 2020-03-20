<!DOCTYPE html>
<html lang="en">

<head>
    <title>Personal Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/style.css" rel="stylesheet">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
</head>
<header>
    <nav>
        <ul>
            <a href="dashboard.php"><img class = "img-link" src="../Pictures/logo.png" alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>            
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../messages.php">Messages</a></li>
            <li><a href="public.php">Public</a></li>
            <li><input class ='search-nav' type="text" name="search" placeholder="Search"></li>
            <form action="" class = "logout-nav">
                <button type="submit" class="btn" name = "logout">Logout</button>
            </form>
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
<footer class = 'login-footer'>  <ul>
    <li>Phone: 717-555-5555</li>
    <li>Email: CommunityJournal@gmail.com</li>
    <li>Fax: 171-123-4567</li>
  </ul>
</footer>

</html>
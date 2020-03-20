<html>

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../Pictures/logo.png">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <nav>
        <ul>
            <a href="dashboard.php"><img class = "img-link" src="../Pictures/logo.png" alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a>
            <li><a href="../messages.php">Messages</a></li>
            <li><a href="personal.php">Personal</a></li>
            <li><a href="public.php">Public</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><input  class ='search-nav' type="text" name="search" placeholder="Search"></li>
            <form action="" class = "logout-nav">
                <button type="submit" class="btn" name = "logout">Logout</button>
            </form>
        </ul>
    </nav>
    <hr>
</header>
<section class = "dash-body">
    <article class = "dash-left">
        <ul>
            <li>recent list 1</li>
            <li>recent list 2</li>
        </ul>
    </article>
    <section class = "dash-middle" name="blog feed">
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
    <article  class = "dash-right" name="search">
        <form action="dashboard.php">
            <input type="text" name="search" placeholder="Filter/Search">
            <button type="submit">Search</button>
        </form>
    </article>
</section>



</body>
<!-- Footer -->
<footer class = 'login-footer'>  <ul>
    <li>Phone: 717-555-5555</li>
    <li>Email: CommunityJournal@gmail.com</li>
    <li>Fax: 171-123-4567</li>
  </ul>
</footer>

</html>
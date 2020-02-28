<html>

<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="logo.png" </head>
    <header>
        <!-- Header Nav -->
        <nav>
            <ul>
                <li><img src="logo.png" alt="logo" name="logo" id="logo"></li>
                <li>Profile</li>
                <li>Messages</li>
                <li>Personal Page</li>
                <li>Search</li>
                <li>Profile</li>
                <li><button type="submit" name="logout" alt="logout">Logout</button></li>
            </ul>
        </nav>
    </header>
    <hr>

<body>
    <section>
        <!-- Profile pic -->
        <article>
            <img src="/yourphotos/profilepic.jpg" alt="profilepic" name="profilepic" id="profilepic">
        </article>
        <article>
            <p>Name</p>
            <p>Country</p>
            <p>Username</p>
            <p>HeadLine</p>
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
            <!-- User can add html code here -->
            <!-- Might need refinement later -->
            <div contenteditable="true">
                This text can be edited by the user.
            </div>
        </article>

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
<footer>
    <p>Community Journal</p>
    <p>Contact Us: communityjournal@support.com</p>
</footer>

</html>
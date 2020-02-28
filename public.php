<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="Pictures/logo.png">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title>Public Page</title>
</head>
    <body>
        <h1>Public Page</h1>
        <ul>
            <li><a href="dashboard.php"><img src="Pictures/logo.png" alt="This is the logo of the company and it also doubles as a home button to the dashboard."></a></li>
            <li><a href="personal.php">Personal</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><input type="text" name="search" placeholder="Search"></li>
            <li><a href="profile.php">Profile</a></li>
            <li>
                <form action="" class = "logout">
                    <button type="submit" class="btn" name = "logout">Logout</button>
                </form>
            </li>
        </ul>
        
        <h2>Create a Post</h2>

        <input type="text" placeholder="Title">
        <input type="blob" placeholder="Picture">
        <button>Attach</button>
        <textarea name="This is your Post Area" cols="200" rows="30"></textarea>

        <input type="text" name="searchblogs" placeholder="Search Blogs">

        <input type="submit" value="Post">

        <footer>
            <ul>
                <li>Phone: 717-555-5555</li>
                <br>
                <li>Email: CommunityJournal@gmail.com</li>
                <br>
                <li>Fax: 171-123-4567</li>
                <br>
            </ul>
        </footer>
    </body>
</html>
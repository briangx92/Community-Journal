<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login to your account</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.scss">
</head>

<body>


    <div class="header">
        <img src="Pictures/logo.png" alt="This is the logo of the company.">
        <h1 id="h1-index"> Community Journal</h1>
    </div>


    <div class="signin-form">
        <form action="" method="post">


            <div class="form-header">
                <h2>Sign In</h2>
                <p>Login to MyChat</p>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="someone@site.com" name="email" autocomplete="off"
                    required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" name="pass" autocomplete="off"
                    required>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in">Sign in</button>
            </div>
            <?php include("include/login.php"); ?>
        </form>
        <div class="text-center small" style='color:#67428B;'>Don't have an account? <a href="views/register.php">Create
                one</a></div>
    </div>



    <footer class='login-footer'>
        <ul>
            <li>Phone: 717-555-5555</li>
            <li>Email: CommunityJournal@gmail.com</li>
            <li>Fax: 171-123-4567</li>
        </ul>
    </footer>

</body>

</html>
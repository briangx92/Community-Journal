<?php
require 'db/db.php';

$email_err = $password_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim(@$_POST["email"]))){
        $email_err = "Please enter username.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim(@$_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);

    }



    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, email, password FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_id, $email, $hash);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hash)){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION['fname'] = $fName;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user_id;
                            $_SESSION["email"] = $email;
                            $_SESSION['approved'] = $approved;
                            print_r($_SESSION["loggedin"]);
                            header("location: http://localhost/Community-Journal/register.php");

                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}


 ?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="Pictures/logo.png">
    <link href="css/main.scss" rel="stylesheet" type="text/css">
    <title>Community Journal</title>
</head>
    <img class = "nav-part" src="Pictures/logo.png" alt="This is the logo of the company.">
    <h1 class = "nav-part2" id = "h1-index"> Community Journal</h1>
    <div class="row">
      <div class="col-6">
        <div class="wrapper">
            <h2 class = "h2-login">Login</h2>
            <form class="login" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input id="email_login" type="text" name="email" class="form-control">
                </div>
                <div class="form-group ">
                    <label>Password</label>
                    <input id="password_login" type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input id="submit_login" type="submit"value="Login">
                </div>
            </form>
        </div>
      
  <div class = "reg-wrapper">
    <button class="registerBtn" onclick="window.location.href = 'http://localhost/Community-Journal/register.php';">Register</button>
  </div>

</div>
</div>
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

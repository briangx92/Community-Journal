<?php


$email_err = $password_err = "";
$username_err = "";



if (isset(($_POST['sub']))) {

    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }






    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) > 10){
        $password_err = "Password must be less than 10 characters.";
    } else{
        $password = trim($_POST["password"]);
    }


    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $gender = $_POST['user-gender'];
    $phone = $_POST['phone'];
    $user = $_POST['username'];
    $country = $_POST['country'];
    $passConfirm = $_POST['verifyPassword'];



    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err)){

      if ($password = $passConfirm) {

        // Prepare an insert statement
        $sql = "INSERT INTO `users` (Fname, Lname, email, phone, username, password, country, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "ssssssss", $param_fName, $param_lName, $param_email, $param_phone, $param_username, $param_password, $param_country, $param_gender);


            $param_fName = $fName;
            $param_lName = $lName;
            $param_email = $email;
            $param_phone = $phone;
            $param_username = $user;
            $param_password = $password;
            $param_country = $country;
            $param_gender = $gender;


            if(mysqli_stmt_execute($stmt)){
<<<<<<< HEAD
              echo"<script>alert('Successfully Created')</script>";
              header("location:http://localhost/Community-Journal/views/index.php");
=======
                echo '<script type="text/javascript">alert("hello!");</script>';
                header("location:http://localhost/Community-Journal/signup-success.html");
>>>>>>> d9033389968ed7de799f934a73a40596ef4952b0
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
  }
  }
?>

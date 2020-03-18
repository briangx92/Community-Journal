<?php
require '../db/db.php';
require '../include/login.php';
 ?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/main.scss" rel="stylesheet" type="text/css">
    <link rel="icon" href="../Pictures/logo.png">
    <title>Community Journal</title>
</head>



  <div class="header">
      <img src="../Pictures/logo.png" alt="This is the logo of the company.">
      <h1 id = "h1-index"> Community Journal</h1>
  </div>


      <div class="wrapper">
        <h2 class="h2-login">Login</h2>
          <form class="login" method="post">
              <div class="form-group">
                  <label>Email</label>
                  <input id="email_login" type="text" name="email" class="form-control">
                  <span class="help-block"><?php echo $email_err; ?></span>
              </div>
              <div class="form-group ">
                  <label>Password</label>
                  <input id="password_login" type="password" name="password" class="form-control">
                  <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group">
                  <input id="submit_login" type="submit"value="Login">
              </div>
        </form>

        <div class="centerWrap" style="text-align: center">
          <div class="center">
              <button class="registerBtn"  onclick="window.location.href = 'http://localhost/Community-Journal/verfication/register.php';">Register</button>
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

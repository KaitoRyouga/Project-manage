<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="style_Login.css">
  <meta charset="UTF-8">
  <title>Form</title>
</head>

<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="inactive underlineHover"> Sign In </h2>
      <h2 class="active">Sign Up </h2>

      <!-- Icon -->
      <div class="fadeIn first">
        <img style="width: 30px; height: 30px;" src="images/user.svg" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form id="main-form" method="POST" action="register1.php">
        <input type="text" name="username_mail" placeholder="Gmail">
        <input type="submit" name="submit" value="Sign Up">
      </form>

      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>
</body>

</html>
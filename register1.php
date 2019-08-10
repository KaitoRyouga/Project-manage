<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="style_Login.css">
  <meta charset="UTF-8">
  <title>Form</title>
    <?php
      require_once 'config.php';
      require_once 'class/user.php';

      $user = new user();

      $mail = $_POST["username_mail"];
      $cofirm_code = $user->cofirm_code();

      if (!empty($_POST["submit"]) and filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo '<script type="text/javascript">alert("Cofirm code: '.$cofirm_code.' ");</script>';
      }
      elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL) and !empty($_POST["submit"])){
        echo '<script type="text/javascript">
                  alert("Invalid email");
                  document.location="http://localhost/php/Project_2/register.php";
              </script>';
      }

      if (!empty($_POST["submit2"])) {
        $info = array();
        $error = array();
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_STRING);
        $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_STRING);
        $info[] = $lname;
        $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_STRING);
        $info[] = $fname;
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $info[] = $username;
        $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
        $info[] = $password;
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRING);
        $info[] = $code;
        $flag = 1;
        for ($i=0; $i < 5; $i++) { 
          if ($info[$i] == "") {
            $error[] = $flag++;
          }
        }

        if (count($error) == 0) {
          $user->registration($mail, $lname, $fname, $password, $code);
          $user->msg = "registration completed";
          $user->print_msg();
          echo "<SCRIPT type='text/javascript'>
              window.location.replace(\"./index.php\");
              </SCRIPT>";
        }else{
          foreach ($error as $key => $value) {
            switch ($value) {
              case 1:
                $user->msg = "Last Name invalid";
                $user->print_msg();
                break;
              case 2:
                $user->msg = "First Name invalid";
                $user->print_msg();
                break;
              case 3:
                $user->msg = "Username invalid";
                $user->print_msg();
                break;
              case 4:
                $user->msg = "Password invalid";
                $user->print_msg();
                break;
              case 5:
                $user->msg = "Cofirm code invalid";
                $user->print_msg();
                break;
              default:
                $user->msg = "Invalid";
                $user->print_msg();
                break;

            }
          }
        }
      }

    ?>
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
      <form id="main-form" method="POST" action="#">
        <input type="text" class="fadeIn second" name="fname" placeholder="Last Name">
        <input type="text" class="fadeIn second" name="lname" placeholder="First Name">
        <input type="text" class="fadeIn second" name="username" placeholder="User Name">
        <input type="text" class="fadeIn second" name="password" placeholder="Passowrd">
        <input type="text" class="fadeIn second" name="mail" value="<?php echo $mail; ?>">
        <input type="text" class="fadeIn second" name="code" value="<?php echo $cofirm_code; ?>">
       
<input type="submit" name="submit2" class="fadeIn fourth" value="Sign Up">
       
      </form>

      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>
</body>

</html>
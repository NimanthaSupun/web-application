<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="login-container">
  <form action="" method="POST" id="loginForm" class="login-form">
  <div class="login-info">
    <h2>Login</h2><br>
    <?php
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }


    if(isset($_SESSION['no-login-message']))
    {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
    }
    ?>
  </div>
  <br>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" placeholder="Enter Username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter Password" required>
    </div>
    <div class="txt-center">
      <p>Login issue? Please Contact IT support</p><br>
    </div>
    <div class="login-info">
        <button type="submit" name="submit" class="submit">Login</button>
    </div>
  </form>
</div>
    
</body>
</html>


<?php 
//Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process the login
    //1. Get Data from Login form
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //2. SQL to check whether the username and password exists or not
    $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

    //3. Execute the QUERY
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //User Available and Login Sucsess
        $_SESSION['login'] = "<div class= 'success'>Login Sucsessful</div>";
        $_SESSION['user'] = $username;//to check whether the user is logged in or not and logout will unset it

        //redirect to home dashboard
        header('location:'.SITEURL.'admin/index.php');
    }
    else
    {
        //user not available
        $_SESSION['login'] = "<div class= 'danger'>Username or Password doesnot match</div>";
        //redirect to home dashboard
        header('location:'.SITEURL.'admin/login.php');
    }
}
?>
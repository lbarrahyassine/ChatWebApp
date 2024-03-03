
<!DOCTYPE html>
<html>

<head>

  <title>Chatapp</title>
  <link rel='icon' src="./images/email.png">
</head>
  <link rel="stylesheet" href="style.css">

<body>

<div class="center">

  <p>login</p> 
  <form name="loginform" action="login.php" method="post">
    <label>Username</label>
    <br>
    <input type="text" name="username">
  
    <br>
  
    <label>Password</label>
    <br>
    <input type="password" name="password">
    <br>
    <br>
    <input id="login" type="submit" value="login" >
  </form> 

  

<a href="createacc.php">create an account</a>
<br>
<a href="forgot_password.html">forgot password</a>

</div>
<?php
if (isset($_GET['error'])) {
    echo "<div class='error-message'><p>Error: " . $_GET['error'] . "</p></div>";
}
?>
</body>

</html>
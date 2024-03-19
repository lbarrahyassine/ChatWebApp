<!DOCTYPE html>
<html>

<head>

  <title>Chatapp</title>
  <link rel='icon' src="./images/email.png">
  <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="center"> 

  <p>signup</p> 
  <form name="createacc" action="" method="post" >
    <label>Username</label>
    <br>
    <input type="text" name="username">

  <br>
    <label>Password</label>
    <br>
    <input type="password" name="password">
  
  <br>
    <label for="email">email</label>
    <br>
    <input type="email" name="email">
    <br>
   <input type="submit" name="submit" value="submit" >

  </form>
 
  <br>
   
  <a href="index.php">login</a>

</div>

<?php 

session_start(); 

include "DB_connection.php";

if (isset($_POST['submit']) ) {

    $username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass= filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;
    }

    $username = validate($username);
    $pass = validate($pass);
    $email = validate($email);

    if (empty($username)) {

      header("Location: createacc.php?error=Username is required");

      exit();

    }else if(empty($pass)){

      header("Location: createacc.php?error=Password is required");

      exit();

    }else{

    $pass_hashed= password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username	, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $pass_hashed);

    if($stmt->execute()){
        echo "<div class='error-message'>account created successfully <br> You can login now</div>";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    }
}

?>
  
</body>

</html>
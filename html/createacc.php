<!DOCTYPE html>
<html>

<head>

  <title>Chatapp</title>
  <link rel='icon' src="./images/email.png">
  <link rel="stylesheet" href="style.css">

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

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    $username = validate($_POST['username']);

    $pass = validate($_POST['password']);
    $email = validate($_POST['email']);
    if (empty($username)) {

      header("Location: createacc.php?error=User Name is required");

      exit();

  }else if(empty($pass)){

      header("Location: createacc.php?error=Password is required");

      exit();
  }else{
    $sql = "INSERT INTO users (username	, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $pass);

    if($stmt->execute()){
        echo "account created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



  }
}
    ?>
  
</body>

</html>
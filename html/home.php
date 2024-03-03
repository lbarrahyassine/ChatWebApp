<?php

include 'DB_connection.php';
session_start();    
$sender_id=$_SESSION['id'];

//$sql = "SELECT * FROM users"; 

    $sql = "SELECT * FROM users WHERE user_id != ?"; 

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sender_id);
    //$stmt = $conn->prepare("SELECT * FROM users ");
    $stmt->execute();

    $result = $stmt->get_result(); 
    $result=$result->fetch_all();
    //print_r($result);

    
    
?>

<!DOCTYPE html>

<head>
  
    <title>User List</title>
    <link rel="stylesheet" href="style.css">

</head>


<body>

<center><h1>HOME</h1></center>
<h1><?php echo "hello ".$_SESSION['username'];?></h1>
<br>
<h1>User List</h1>


<ul class="user-list">
    
<?php 
$_SESSION['id2']=null;
foreach ($result as $row ){
        echo" <li> <a href=discussion.php?id=".$row[0].">" . $row[1]." </a>      </li>";
        
    }
    ?>


</ul>



</body>
</html>

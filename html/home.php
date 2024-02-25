<?php

include 'DB_connection.php';
session_start();    
$loggedInUserID=$_SESSION['id'];

//$sql = "SELECT * FROM users"; 

    $sql = "SELECT * FROM users WHERE user_id != ?"; 

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $loggedInUserID);
    //$stmt = $conn->prepare("SELECT * FROM users ");
    $stmt->execute();

    $result = $stmt->get_result(); 
    $result=$result->fetch_all();
    //print_r($result);

    
    
?>

<!DOCTYPE html>

<head>
  
    <title>User List</title>
    <style>
        
        .user-list {
            list-style-type: none;
            padding: 0;
        }
        .user-list li {
            margin-bottom: 5px;
        }
        .user-list li {
    background-color: #fff;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.user-list li:hover {
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
    </style>

</head>


<body>

<h1>HOME</h1>
<br>
<h1>User List</h1>


<ul class="user-list">
    
<?php 
$_SESSION['id2']=null;
foreach ($result as $row ){
        echo" <li> <a href=discussion.php?id=".$row[0].">".    $row[1]." </a>      </li>";
    }
    ?>


</ul>



</body>
</html>

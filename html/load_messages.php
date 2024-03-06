<?php

session_start();
include 'DB_connection.php';


if (!isset($_SESSION['id2'])){

    $receiver_id = $_GET['id'];
    $_SESSION['id2'] = $receiver_id;
} else {
    $receiver_id =$_SESSION['id2'];
}

$sender_id = $_SESSION['id'];   
?>


<!DOCTYPE html>
<html>
<head>
    <title>Discussion</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<div >

<?php    
    // this is the same code of discussion.php 
    // this is the code I want to refresh every 250ms or so

    $sql = "SELECT * FROM messages WHERE (destinateur = ? AND destinataire = ?) OR (destinateur = ? AND destinataire = ?) ORDER BY time	";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$sender_id, $receiver_id, $receiver_id,$sender_id ]);
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()){
        //print_r($row);
        if ($row['destinateur']==$sender_id){

            echo "<div class='mess_sent'><span>".$row['mess_text']."</span></div>";
        }else {
            echo "<div class='mess_rece'><span>".$row['mess_text']."</span></div>";
        }
        
    }
$stmt=null;
?>

  

</div>


</body>

</html>
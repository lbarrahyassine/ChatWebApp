<?php

session_start();
include 'DB_connection.php';


//echo "receiver id is ".$_SESSION['id2'];
//echo "<br>my id is ".$_SESSION['id'];

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

<div class="discussion" id="discc">

<?php    
    // Get the messages between the current user and the selected user

    $sql = "SELECT * FROM messages WHERE (destinateur = ? AND destinataire = ?) OR (destinateur = ? AND destinataire = ?) ";
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

<br>

<div class="txtbox">
    <form method="POST" action="send_mess.php" id="formid" enctype='multipart/form-data'>
        <textarea id="textarea" name="message" placeholder="Type your message here..."></textarea><br>
        <input id="sendmess" type="submit" name="sdmessage" value="Send Message">
    </form>  
</div>


<script src="chat.js"></script>
</body>

</html>
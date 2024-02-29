<?php
session_start();


$sender_id = $_SESSION['id'];
$receiver_id = $_SESSION['id2'];

include 'DB_connection.php';


if(isset($_POST['submit'])){
    
    $message = $_POST['message'];

    
    $sql = "INSERT INTO messages (mess_text, destinateur, destinataire) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    
    $stmt->bind_param("sii", $message, $sender_id, $receiver_id);

   
    if ($stmt->execute([ $message, $sender_id, $receiver_id])) {
        
        header("Location: discussion.php");
        $sender_id = $_SESSION['id'];
        
    } else {
        
        echo "Error: Message insertion failed.";
    }
}
?>
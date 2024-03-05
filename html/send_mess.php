<?php
session_start();

$sender_id = $_SESSION['id'];
$receiver_id = $_SESSION['id2'];

include 'DB_connection.php';

if(isset($_POST['sdmessage'])){
    
    $message = $_POST['message'];
    //$message = $_POST['message'];

    // Print out the $_POST array
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";

    $sql = "INSERT INTO messages (mess_text, destinateur, destinataire) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sii", $message, $sender_id, $receiver_id);

    if ($stmt->execute()) {
        echo "Message inserted successfully.";
        header("Location: discussion.php");
        $sender_id = $_SESSION['id'];
    } else {
        echo "Error: Message insertion failed.";
        // Print any SQL error
        echo "SQL Error: " . $stmt->error;
    }
}
?>
<script src="chat.js"></script> 
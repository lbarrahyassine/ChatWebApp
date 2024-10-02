<?php 

session_start(); 
include "DB_connection.php";

if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])) {

    $username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass= filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $username = validate($username);
    $pass = validate($pass);

    if (empty($username)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username= ?";
        $sql = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($sql, "s", $username);
        mysqli_stmt_execute($sql);
        $result = mysqli_stmt_get_result($sql);
        
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // Debugging: Check if the password field exists and its value
            if (isset($row['password'])) {
                // echo "Password hash from DB: " . $row['password'] . "<br>"; // Debugging
                if (password_verify($pass, $row['password'])) {
                    
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['user_id'];
                    header("Location: home.php");
                    exit();
                } else {
                
                    header("Location: index.php?error=Incorrect Username or password");
                    exit();
                }
            } else {
                echo "No password found in the database"; // Debugging
                header("Location: index.php?error=Incorrect Username or password");
                exit();
            }
        } else {
            
            header("Location: index.php?error=Incorrect Username or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}

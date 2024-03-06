<?php

$hostname= "chatapp";

$usname= "root";

$password = "";

$db_name = "chatappdata";

$conn = mysqli_connect($hostname, $usname, $password, $db_name);

if (!$conn) {

    echo "Connection failed!";

}
?>
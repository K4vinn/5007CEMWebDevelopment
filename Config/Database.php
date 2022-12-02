<?php
session_start();
$sname = 'localhost';
$username = 'root';
$password = '';

$db_name = "pictureclub";

$conn = mysqli_connect($sname, $username, $password, $db_name);

if (!$conn) {
    echo "Connection failed";
    exit();
}
?>


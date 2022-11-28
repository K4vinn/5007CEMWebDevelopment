<?php
include ("Config/Database.php");

$url = $_SERVER['REQUEST_URI'];
$pictureid = preg_replace("/[^0-9]/", '', $url);

if (isset($_GET["id"])) {
    $pictureid = $_GET ["id"];
}

$sql_query = "SELECT * FROM images WHERE id = '$pictureid' ";
$res=$conn->query($sql_query);

function setComment($conn) {

    if (isset($_POST['submitComment'])) {

        $userid = $_POST['userid'];
        $date = $_POST['date'];
        $commentmessage = $_POST['commentmessage'];
        $photoid = $_POST['photoid'];

        $sql = "INSERT into comments (userid, date, commentmessage, photoid) 
        VALUES ('$userid', '$date', '$commentmessage', '$photoid')";
        $results = $conn -> query($sql);
    }
}

function getComments($conn) {
    $sql = "SELECT * FROM comments";
    $result = $conn -> query($sql);

    $url3 = $_SERVER['REQUEST_URI'];
    $pictureid2 = preg_replace("/[^0-9]/", '', $url3);

    if (isset($_GET["id"])) {
        $pictureid2 = $_GET ["id"];
    }

               
    while($row = $result->fetch_assoc()) {
        if ($row['photoid'] == $pictureid2) {
                echo "<div class='commentbox'>";
                echo "<p class='namedate'>";
                echo $row['userid']. " ";
                echo "(";
                echo $row['date'];
                echo ")";
                echo "</p>";
                echo "<p class='commentitself'>";
                echo $row['commentmessage']. "<br>";
                echo "</p>";
                echo "</div>";
            
        }
    }
}


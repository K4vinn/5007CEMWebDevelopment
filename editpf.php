<?php
include "Config/Database.php";

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("refresh:0.01; url='login.php'");
    echo
    "<script> alert('Login to access profile!') </script>";
}

$getusername = "SELECT * FROM user WHERE id = '$id'";
$getname = $conn->query($getusername);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="CSS/navbar.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="CSS/editpf.css">
    </head>
    <body>
    <h1 class='page-title'> The Pictr. Club </h1>
        <div class="header">
            <form class='disp' action="" method="post">
            <input class='search' name='search' id="search" type='search' required placeholder='Search a tag!'> </input> 
            <button type='submit' class="searchtag" name='tags' id="tags"> Enter </button>
            </form>

            <div class='topnav'>
                <a href="profile.php"> <img class="pfp" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png" alt="user" /> </a>
                <a class='navlist' href='profile.php'> Profile </a>
                <a class='navlist' href='create.php'> Create </a>
                <a class='navlist' href='saved.php'> Saved </a>
                
            </div>
        </div>


        <?php 
        if (isset($_POST['edit'])){
            $username = $_POST['username'];
            $bio = $_POST['userbio'];

            $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

            if (mysqli_num_rows($duplicate) > 0 ){
                echo
                "<script> alert('Username has already been used!') </script>";
            } else {
                $edituserprofile = "UPDATE user SET username = '$username', userbio = '$bio' WHERE id = '$id'";
                $newsql = mysqli_query($conn, $edituserprofile);
                if ($newsql) {
                    header('Location: profile.php');
                }
            }
        }
        
        ?>

        <div class="container"> 
            <h1> Edit Profile</h1>
            <div>
            <?php
        if (mysqli_num_rows($getname) > 0) {
            while ($user = mysqli_fetch_assoc($getname)) {
                ?>
                <form class="" action="" method="post" autocomplete="off">
                    <label class='labels'> Username </lable>
                    <input class="inputl" type="text" name="username" id="username" placeholder="New Username" required value="<?= $user['username'] ?>"> <br/>
                    <label class='labels'> Bio </lable>
                    <input class="inputl" type="text" name="userbio" id="userbio" placeholder=" New Bio" required value="<?= $user['userbio'] ?>"> <br/>
                    <p class='disclaimer'> [i] Changing your username will change the login credential of your email [i] </p>
                    <button class="buttonl" type="submit" name="edit"> Confirm Edit </button>
                    <button class="buttonl" type="button" onclick="location.href = 'profile.php'"> Cancel Edit </button>
                    
                </form>
         <?php
           }
        }
        ?>
            </div>
</html>
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
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="CSS/navbar.css">
        <link rel="stylesheet" href="CSS/profile.css"
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
        <div class="header">
            <a href="index.php" class='page-title'> The Pictr. Club </a>
            <input class='search' type='search' placeholder='Whats on your mind today?'>

            <div class='topnav'>
                <a href="index.php"> <img class="pfp" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png" alt="user" /> </a>
                <a class='navlist' href='profile.php'> Profile </a>
                <a class='navlist' href='create.php'> Create </a>
                <a class='navlist' href='saved.php'> Saved </a>
            </div>
        </div>
        
        <br/>
        
        <div class="profile-card" style="width: 30rem">
            <img class='profile-picture' src='Image/Icon.jpg'/>
            <p> @Username </p>
            <div class='bio-card'>
                <p> Enter Bio Text </p>
            </div>
            <button class='btnedit' type='submit'> Edit Profile </button>
            <br/>
            <a class='logout' href="logout.php" type='submit'> Logout </a>
        </div>
</html>
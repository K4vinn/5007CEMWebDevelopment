<?php
include "Config/Database.php";
$search_URL = "http://localhost/phptest/searched.php?search?q=";
if (isset($_POST ["tags"])){
    $search=$_POST['search'];
    header("location: ". $search_URL.$search.' ');
}

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
        <link rel="stylesheet" href="CSS/profile.css"
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/main.css">
    </head>
    <body>
        <div class="header">
            <a href="index.php" class='page-title'> The Pictr. Club </a>
            <form action="" method="post">
            <input class='search' name='search' id="search" type='search' required placeholder='Search a tag!'> </input> 
            <button type='submit' class="searchtag" name='tags' id="tags"> > </button>
            </form>

            <div class='topnav'>
                <a href="profile.php"> <img class="pfp" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png" alt="user" /> </a>
                <a class='navlist' href='profile.php'> Profile </a>
                <a class='navlist' href='create.php'> Create </a>
                <a class='navlist' href='saved.php'> Saved </a>
            </div>
        </div>
        
        <br/>
        
        <div class="profile-card" style="width: 30rem">
            <img class='profile-picture' src='Image/Icon.jpg'/>
            <?php
        if (mysqli_num_rows($getname) > 0) {
            while ($user = mysqli_fetch_assoc($getname)) {
                ?>
            <p><?= $user['username'] ?></p>

            <div class='bio-card'>
                <p name="userbio"> <?= $user['userbio'] ?> </p>
            </div>
            <button class='btnedit' onclick="location.href = 'editpf.php'" type='submit'> Edit Profile </button>
            <br/>
            <button class='logoutbtn' onclick="location.href = 'logout.php'"> Logout </button>
        </div>
        <?php
            }
        }
?>

    
     
</html>
<?php
include "Config/Database.php";
$search_URL = "http://localhost/phptest/searched.php?search?q=";
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    echo
    "<script> alert('Login to access your saved pictures!') </script>";
    header("Location: login.php");
}

if (isset($_POST ["tags"])){
    $search=$_POST['search'];
    header("location: ". $search_URL.$search.' ');
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="CSS/navbar.css">
        <link rel="stylesheet" href="CSS/save.css"
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <div class="header">
            <a href="index.php" class='page-title'> The Pictr. Club </a>
            <form action="" method="post">
            <input class='search' name='search' id="search" type='search' required placeholder='Search a tag!'> </input> 
            <button type='submit' class="searchtag" name='tags' id="tags"> > </button>
            </form>

            <div class='topnav'>
                <a href="profile.php"> <img class="pfp" 
                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png" alt="user" /> </a>
                <a class='navlist' href='profile.php'> Profile </a>
                <a class='navlist' href='create.php'> Create </a>
                <a class='navlist' href='saved.php'> Saved </a>
            </div>
        </div>

        <div class='title'> 
            <h2> Saved Photos of your journey! </h2> 
        </div>


        <!-- Change only this part. -->
        <div class="container">
            <?php
            $sql = "SELECT * FROM saved ORDER BY saveid DESC";
            $res = mysqli_query($conn, $sql);
            $curId = $_SESSION['id'];

            $newsql = "SELECT * FROM user";
            $results = mysqli_query($conn, $sql);

           
                if (mysqli_num_rows($res) > 0) {
                    while ($saved = mysqli_fetch_assoc($res)) {
                        if($curId == $saved['saveuserid']){
                        ?>
                        <div class='pContainer'>
                            <div class='pictureContainer'>
                                <div class="picture">
                                    <img class='item' src="uploads/<?= $saved['photourl'] ?>">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                }
        
                ?> 
            
        
        </div>


    </body>
</html>


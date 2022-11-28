<?php
include "Config/Database.php";
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="CSS/navbar.css">
        <link rel="stylesheet" href="CSS/pictures.css">
        <link rel="stylesheet" href="CSS/tag.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


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

        <div class='box'>
            <ul>
                <h3> Tags </h3>
                <li class="listItem"> <a href="#"> Clothing<a/> </li>
                <li class="listItem"> <a href="#"> Photography<a/> </li>
                <li class="listItem"> <a href="#"> Art<a/> </li>
                <li class="listItem"> <a href="#"> Flowers<a/> </li>
            </ul>
        </div>


        <div class="container">
            <?php
            $sql = "SELECT * FROM images ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($images = mysqli_fetch_assoc($res)) {
                    ?>
                    <div class='pContainer'>
                        <div class='pictureContainer'>
                            <div class="picture">
                                <a href="details.php?/uploads/link?id=<?= $images['id'] ?>"> <img class='item' src="uploads/<?= $images['image_url'] ?>"> </a>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>


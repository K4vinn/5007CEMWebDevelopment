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
    echo
    "<script> alert('Login to access your saved pictures!') </script>";
    header("Location: login.php");
}

$url = $_SERVER['REQUEST_URI'];
$new = explode("/searched.php?search?q=",$url);

if (isset($_GET['tags'])){
    $new[1] = $_GET['tags'];
}

$query = "SELECT * FROM images WHERE tags = '$new[1]'";
$res = $conn->query($query);

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="CSS/navbar.css">
        <link rel="stylesheet" href="CSS/save.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <a href='index.php'> <h1 class='page-title'> The Pictr. Club </h1> </a>
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

        <div class='title'> 
            <h2> Search of...<?php echo $new[1]?> <h2> 
        </div>


        <!-- Change only this part. -->
        <div class="container">
            <?php
            // get from the new saved db
            $sql = "SELECT * FROM images ORDER BY tags ASC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($images = mysqli_fetch_assoc($res)) {
                    if ($images['tags'] == $new[1]){
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
            }
            ?>
        </div>


        </body>
    </html>
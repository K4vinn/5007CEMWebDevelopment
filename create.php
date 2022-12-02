<?php
include "Config/Database.php";
$search_URL = "http://localhost/phptest/searched.php?search?q=";
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    echo
    "<script> alert('Login to create!') </script>";
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="CSS/navbar.css">
        <link rel="stylesheet" href="CSS/create.css">
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

        <?php if (isset($_GET['error'])): ?>
            <p> <?php echo $_GET['error']; ?> </p>
        <?php endif ?>

        <div class="upload-card">
            <h3> Upload a Photo! </h3>
            <img class="preview-card" id="output"/>
            <form action ='upload.php' method='post' enctype="multipart/form-data" class='cForm'>
                <input name='my_image' id='input-photo' class='upload' hidden type="file" accept="image/*" onchange="loadFile(event)"> 

                <label class='upload' for='input-photo' > Upload Image </label> <br/>

                <input class='inputf' name='title' id='title' type="text" placeholder="Title">

                <input class='inputf' name='description' id='description' type="text" placeholder="About Picture"> <br/>

                <input class='inputf' name='tags' type="text" id='tags' placeholder="Enter tags regarding the picture"> <br/>

                <button class='btnsbmt' name='submit' type='submit' value ="Upload"> Submit </button>

            </form>

            <script>
                //Script for preview image.
                var loadFile = function (event) {
                    event.preventDefault();
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = document.getElementById('output');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                };
            </script>
        </div>
    </body>
</html>

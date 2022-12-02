<?php
// include ("Config/Database.php");
include ("comments.php");

$search_URL = "http://localhost/phptest/searched.php?search?q=";
$id = preg_replace("/[^0-9]/", '', $url);

if (isset($_GET["id"])) {
    $id = $_GET ["id"];
}

$sql_query = "SELECT * FROM images WHERE id = '$id' ";
$res=$conn->query($sql_query);

if (isset($_POST ["tags"])){
    $search=$_POST['search'];
    header("location: ". $search_URL.$search.' ');
}
?>

<head>
    <meta charset="UTF-8">
    <title>The Pictr. Club</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/create.css">
    <link rel="stylesheet" href="CSS/details.css">
    <link rel="stylesheet" href="CSS/comments.css">
    <link rel="stylesheet" href="CSS/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Scripts for bootstrap js and query -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

    <div class="detailscontainer">
        <?php
        if (mysqli_num_rows($res) > 0) {
            while ($images = mysqli_fetch_assoc($res)) {
                ?>
                <!-- Images From Database! -->
                <div class="preview"> 
                    <img class='item' src="uploads/<?= $images['image_url'] ?>">
                </div>

                <!-- Share Icon to Modal -->
                <img class="share" src="Icons/share.png" data-toggle="modal" data-target="#exampleModal"/>
                <!-- Button trigger modal -->

                <!-- Requires CSS modifications -> Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Get Link</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>

                      <!-- Inside the modal -->
                      <div class="modal-body">
                        <?php 
                            $geturl = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];;
                        ?>

                        <input type="text" id="urlcopy" value="<?= $geturl ?>"/>
                      </div>

                      <!-- Footer Buttons -->
                      <div class="modal-footer">
                        <button type="button" class="closebtn" data-dismiss="modal">Close</button>
                        <button type="button" class="copybtn" onclick="copyItem();">Copy URL</button>
                      </div>

                      <!-- Copy Text Function, gets value in the id related. -->
                      <script> 
                        function copyItem() {
                        var copytext = document.getElementById("urlcopy");
                        copytext.select();
                        copytext.setSelectionRange(0, 99999);

                        navigator.clipboard.writeText(copytext.value);
                        alert("URL Link has been copied!");
                        }
                      </script>

                    </div>
                  </div>
                </div>

                <div class="details">
                    <h3> <?= $images['title'] ?> </h3>
                    <div class="bio">
                        <p> <?= $images['description'] ?></p>
                    </div>
                </div>

                <?php 
                if (isset($_POST['savetosaved'])) {
                    //For the image url
                    $imagesql = "SELECT * FROM images";
                    $imageres = mysqli_query($conn, $imagesql);

                    $uid = $_SESSION['id'];
                    $usersql = "SELECT * FROM user";
                    $userres = mysqli_query($conn, $usersql);

                    $imageurl = $_SERVER['REQUEST_URI'];
                    $imageid = preg_replace("/[^0-9]/", '', $imageurl);

                    if (isset($_GET["id"])) {
                        $imageid = $_GET ["id"];
                    }

                    if (mysqli_num_rows($imageres) > 0 ) {
                        while ($images = mysqli_fetch_assoc($imageres)){
                            if ($images['id'] == $imageid){
                                $newid = $images['id'];
                                $newurl = $images['image_url'];
                                $q = "INSERT into saved (savephotoid, photourl) VALUES ('$newid', '$newurl')";
                                $resultq = $conn -> query($q);
                            }
                        }
                    }
                        sleep(1);

                        if (mysqli_num_rows($userres) > 0){
                            while ($users = mysqli_fetch_assoc($userres)){
                                if ($users['id'] == $uid) {
                                    $newuserid = $users['id'];
                                    $savesql = "SELECT * FROM saved";
                                    $saveres = mysqli_query($conn, $savesql);
                                    if(mysqli_num_rows($saveres) > 0){
                                        while ($save = mysqli_fetch_assoc($saveres)){
                                            if ($save['savephotoid'] == $imageid){
                                                $n = "UPDATE saved SET saveuserid= ('$newuserid')";
                                                $resn = $conn -> query($n);
                                                echo '<script> alert ("Save was successful!"); </script>';
                                            }
                                        }
                                    }
                                }
                            } 
                        }
                    }
                ?>

                <form method='post'>
                    <button class="save-btn" type="submit" id='savetosaved' name='savetosaved' value='savedtosaved'> Save </button>
                <form/>

                <input type='button' class="back-btn" onclick="location.href = 'index.php'" type="submit" value="Back to Home"/>
                <?php
            }
        }
        ?>
    </div>

    <?php 
        date_default_timezone_set('Asia/Kuala_Lumpur');
        ?>

    <div class="comments">

<?php
if (isset($_SESSION['id'])){
    $currentId = $_SESSION['id'];
    $sql_query = "SELECT * FROM user WHERE id = '$currentId'";
    $results=$conn->query($sql_query);

    $url2 = $_SERVER['REQUEST_URI'];
    $id2 = preg_replace("/[^0-9]/", '', $url2);

    if (isset($_GET["id"])) {
        $id2 = $_GET ["id"];
    }
    
    if (mysqli_num_rows($results) > 0) {
        while ($user = mysqli_fetch_assoc($results)) {
            
    echo 
    "
        <h4> Comments </h4>
        <form method='POST' action='".setComment($conn)."' >
            <input type='hidden' name='userid' value='$user[username]'/>
            <input type='hidden' name='date' value='".date('Y-m-d')."'/>
            <textarea placeholder='Enter comment' class='inputarea' name='commentmessage'> </textarea><br/>
            <input type='hidden' name='photoid' value='$id2'/>
            <button class='cmtbtn' name='submitComment' type='submit'> Submit Comment </button>
        </form>
        ";

        getComments($conn); 
        }
    }
}
  ?>
    </div>





<?php
include ("Config/Database.php");

$url = $_SERVER['REQUEST_URI'];
$id = preg_replace("/[^0-9]/", '', $url);

if (isset($_GET["id"])) {
    $id = $_GET ["id"];
}

$sql_query = "SELECT * FROM images WHERE id = '$id' ";
$res=$conn->query($sql_query);
?>

<head>
    <meta charset="UTF-8">
    <title>The Pictr. Club</title>
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/create.css">
    <link rel="stylesheet" href="CSS/details.css">
    <link rel="stylesheet" href="CSS/comments.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

                <!-- Modal -->
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
                    <h3> title </h3>
                    <div class="bio">
                        <p> Picture is about Hall Design</p>
                    </div>
                </div>

                <button class="save-btn" type="submit"> Save </button>
                <input type='button' class="back-btn" onclick="location.href = 'index.php'" type="submit" value="Back to Home"/>
                <?php
            }
        }
        ?>
    </div>

    <div class="comments">
        <h4> Comments </h4>
        <form id="frm-comment">
            <div class="input-row">
                <div class="label">Name:</div>
                <input type="hidden" name="comment_id" id="commentId" /> <input
                    class="input-field" type="text" name="name" id="name"
                    placeholder="Enter your name" />
            </div>
            <div class="input-row">
                <textarea class="input-field" name="comment" id="comment"
                          placeholder="Your comment here"></textarea>
            </div>
            <div>
                <input type="button" class="btn-submit" id="submitButton"
                       value="Publish Comment" />
            </div>
        </form>
    </div>



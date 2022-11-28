<?php
include "Config/Database.php";

if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        } else {
            echo
            "<script> alert('Wrong Password!') </script>";
        }
    } else {
        echo
        "<script> alert('Unfortunately, this account is not registered!') </script>";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div class="container"> 
            <h1> The Pictr. Club</h1>
            <p> Login<p/>
            <div>
                <form class="" action="" method="post" autocomplete="off">
                    
                    <input class="inputl" type="text" name="usernameemail" id="usernameemail" placeholder="Username or Email" required value=""> <br/>
                
                    <input class="inputl" type="password" name="password" id="password" placeholder="Password" required value=""> <br/>

                    <button class="buttonl" type="submit" name="submit"> Login </button>
                    
                </form>
                
                <br/>
                <p class="accno"> First time here? <a href="register.php"> Register now! </a></p>
                <br/>
            </div>


    </body>
</html>

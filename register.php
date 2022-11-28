<?php
include "Config/Database.php";

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, 
    "SELECT * FROM user WHERE username = '$username' or email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo
        "<script> alert('Username or Email has already been created!') </script>";
    } else {
        if ($password == $confirmpassword){
            $query = "INSERT INTO user VALUES('', '$username', '$email','$password')";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Registration has been completed! Welcome to the picture club!') </script>";
            // sleep(3);
            // header("Location: login.php");
        } else {
            echo
            "<script> alert('Registration failed! Please try again later!') </script>";
        }
    }
}


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>The Pictr. Club</title>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div class="container"> 
            <h1> The Pictr. Club</h1>
            <p> Registration <p/>
            <div>
                <form class="" action="" method="post" autocomplete="off">
                    
                    
                    <input class="inputr" type="text" name="username" id="username" placeholder="Username" required value=""> <br/>
                 
                    
                    <input class="inputr" type="text" name="email" id="email" placeholder="Email" required value=""> <br/>
                
                    
                    <input class="inputr" type="password" name="password" id="password" placeholder="Password" required value=""> <br/>
                    
                    
                    <input class="inputr" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required value=""> <br/>
                    

                    <button class="buttonr" type="submit" name="submit"> Register! </button>
                    
                </form>
                
                <br/>
                <p class="accyes"> Already have an account? <a href="login.php"> Login Now! </a></p>
                <br/>
                
            </div>


    </body>
</html>


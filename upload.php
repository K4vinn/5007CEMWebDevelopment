<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    
    include "Config/Database.php";

    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    // $duplicate = mysqli_query($conn,
    // "SELECT * FROM images WHERE title='$title'");

    // if (mysqli_num_rows($duplicate) > 0){
    //     echo "<script> alert('Image Title Already Exists') </script>";
    // } else {
    //     $query2 = "INSERT INTO images VALUES('','$title','$description','$tags')";
    //     mysqli_query($conn, $query2);
    //     echo
    //     "<script> alert('Photo has been posted!') </script>";
    // }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 1500000000) {
            $em = "File is too big!";
            header("Location: index.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_ex = array('jpg', 'jpeg', 'png', 'gif');   

            if (in_array($img_ex_lc, $allowed_ex)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_path);
                
                //insert into database
                $sql = "INSERT INTO images(image_url, title, description, tags)
                        VALUES('$new_img_name', '$title' , '$description' , '$tags')";
                mysqli_query($conn, $sql);
                header("Location: index.php");
            } else {
                $em = "File is too big!";
                header("Location: index.php?error=$em");
            }
        }
    } else {
        $em = "unknown error has occured";
        header("Location: index.php?erorr=$em");
    }
} else {
    header("Location: index.php");
}


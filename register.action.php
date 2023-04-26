<?php
    // fixing image
    $orig_file = $_FILES["avatar"]["tmp_name"];
    $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    $target_dir = "assets/uploads/posts/";
    $destination = "$target_dir$randomstring$userId.$ext";
    move_uploaded_file($orig_file, $destination);
    $user->setProfileImage($destination);
    $pfpicupload = 1;
    $basisinfo = 1;
    $user->setUser();
    die();
    header("Location: ./login.php");
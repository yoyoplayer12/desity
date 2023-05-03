<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if($_SESSION['loggedin'] === true) {
        try{
           //hier code fixen
            header("Location: ./index.php");
        }
        catch(Throwable $e){
                echo $e->getMessage();
        }
    }
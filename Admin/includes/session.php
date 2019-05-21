<?php
session_start();
if(!isset($_SESSION['user']) && $_SESSION['user'] == null)
{
header('location:../index.php');
}else {
    if($_SESSION['user']['Role'] == 'admin'){

    }else{
        header('location:../index.php');
    }
}
?>
<?php 

session_start();


if (isset($_SESSION['count'])){
    $_SESSION['count'] = $_SESSION['count'] + 1;
    header('Location: tast_13.php');
}else{
    $_SESSION['count'] = 1;
}
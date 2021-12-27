<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $text = $_POST['text'];
    $text = htmlspecialchars($text, ENT_COMPAT | ENT_HTML5);
    $_SESSION['text'] = $text;
    header("Location: task_12.php");
}
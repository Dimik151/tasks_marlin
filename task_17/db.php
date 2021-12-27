<?php 

$user_name = 'root';
$user_pass = '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tasks', $user_name, $user_pass);
} catch (PDOException $e) {
    echo "Нвозможно установить соединение с базой данных";
}


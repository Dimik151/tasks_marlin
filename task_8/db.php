<?php

$user_name = 'root';
$user_pass = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=tasks', $user_name, $user_pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$users = $db->query('SELECT * FROM users');


function get_columns ()
{
    global $db;
    $stmt = $db->query('SELECT * FROM users', PDO::FETCH_ASSOC);
    return $stmt;
}

function get_column ($id) 
{
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE id = :id;');
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_insert ($params)
{
    global $db;
    $stmt = $db->exec('INSERT INTO users (name, first_name, last_name, username) VALUES ()');

}



?>
<?php 

session_start();

$user_name = 'root';
$user_pass = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=tasks', $user_name, $user_pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $auth = veritify_user();
    if ($auth){
        $_SESSION['login'] = $auth;
    }else{
        $_SESSION['err'] = 'Неверный логин или пароль';
    }
header('Location: task_14.php');
}



function veritify_user() {
    global $db;
    $errros = '';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM login WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if (!$user){
        $errros = "Неверное имя или пароль";
    }else{
        if (!password_verify($password, $user['password'])){
            $errros = "Неверный пароль";
        }else{
            return $user['email'];
        }
    }
    return FALSE;
}
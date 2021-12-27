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
    $err = [];

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password']);

    if ($email === FALSE){
        $err[] = 'Введите корректный эл адрес';
    }

    if (!(mb_strlen($password) >= 6)){
        $err[] = "Пароль должен содержать более 6 символов";
    }
    
    $stmt = $db->prepare('SELECT * FROM login WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch();
    if ($result !== FALSE){
        $err[] = "Этот эл адрес уже занят другим пользователем";
    }

    if (count($err) == 0){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare('INSERT INTO login (email, password) VALUES (:email, :password)');
        $stmt->execute(['email' => $email, 'password' => $password]);
        $_SESSION['ok'] =  "Успешно добавлен";
    }

    $_SESSION['err'] = $err;

    header('Location: task_11.php');
    
}













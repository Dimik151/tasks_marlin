<?php 

session_start();

$host = 'localhost';
$dbname = 'tasks';
$username = 'root';
$password = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}catch (PDOException $e){
    echo "Подключение к базе прервано . $e->getmessage";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ((isset($_FILES['file']) && (!in_array(UPLOAD_ERR_OK, $_FILES['file']['error'])))){
        $_SESSION['errors'] = "Загрузите в форму хотя бы один файл";
    }else{
        $files = $_FILES['file'];
        $message = file_load($files);
        $_SESSION['message'] = $message;
    }
    header('Location: task_19.php');
}

if (!empty($_GET['del'])){
    $id = $_GET['del'];
    $image = where_db_file($id);
    if ($image){
        delete_db_file($id);
        delete_path_file($image['img_src']);
    }
    header('Location: task_19.php');
}

function save_db_file($filename){
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO images (img_src) VALUES (:img_src)');
    $stmt->execute(['img_src' => $filename]);
}

function select_db_file(){
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM images');
    $stmt->execute();
    $statament = $stmt->fetchAll();
    return $statament;
}

function where_db_file($id){
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM images WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $statament = $stmt->fetch(PDO::FETCH_ASSOC);
    return $statament;
}

function delete_db_file($id){
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM images WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function delete_path_file($name){
    // $name_file = where_db_file($id);
    $image_path = 'img/';
    unlink($image_path . $name);
}

function re_name_img ($file) {
    $image_path = 'img/';
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $name = strftime('%Y%m%d%H%M');
    $postfix = '';
    $number = 0;
    while (file_exists($image_path . $name . $postfix . '.' . $ext)){
        $postfix = '__' . ++$number;
    }
    return $name . $postfix . '.' . $ext;
}

function file_load ($files){
    $errors = [];
    $file_path = 'img/';
    $cnt_files = count($files['name']);
    for ($i = 0; $i < $cnt_files; $i++){
        $ext = FALSE;
        if ($files['error'][$i] == UPLOAD_ERR_OK){
            switch($files['type'][$i]){
                case 'image/gif':
                    $ext = 'gif';
                    break;
                case 'image/png':
                    $ext = 'png';
                    break;
                case 'image/jpeg':
                    $ext = 'jpeg';
                    break;
            }
            if ($ext){
                $name = re_name_img($files['name'][$i]);
                $tmp_name = $files['tmp_name'][$i];
                if (move_uploaded_file($tmp_name, "$file_path/$name")) {
                    save_db_file($name);
                    $errors[$i] = "Файл успешно загружен в систему<br>";
                }else{
                    $errors[$i] = "Неудачная загрузка файла<br>";
                }
            }else{
                $errors[$i] = "Неверный формат изображения<br>";
            }
        }
    }
    return $errors;
}


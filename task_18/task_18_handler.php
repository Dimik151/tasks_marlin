<?php 
session_start();

require_once ('db.php');

$base_path = __DIR__;
$image_path = '/img/';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $file = $_FILES['file'];
    if (isset($_FILES['file']) && (in_array(UPLOAD_ERR_OK, $file['error']))) {
        if (save_file_arr($file)){
            $_SESSION['file_load'] = 'Файл успешно загружен';
        }
    }else{
        $_SESSION['file_load'] = "Файл не загружен";
    }
    header('Location: task_18.php');
}

if (isset($_GET['del'])){
    $delete = delete_img($_GET['del']);
    if ($delete){
        $_SESSION['file_load'] = 'Файл успешно удален';
    }
    header('Location: task_18.php');
}



function re_name_img ($file) {
    global $base_path;
    $image_path = $base_path . '/img/';
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $name = strftime('%Y%m%d%H%M');
    $postfix = '';
    $number = 0;
    while (file_exists($image_path . $name . $postfix . '.' . $ext)){
        $postfix = '__' . ++$number;
    }
    return $name . $postfix . '.' . $ext;
}

// function save_file($file) {
//     global $base_path;
//     global $pdo;

//     $image_path = $base_path . '/img/';
//     $filename = re_name_img($file);
//     if (move_uploaded_file($file['tmp_name'], $image_path . $filename)) {
//         $stmt = $pdo->prepare('INSERT INTO images (img_src) VALUES (:img_src)');
//         $stmt->execute(['img_src' => $filename]);
//         return $filename;
//     }
//     return FALSE;
// }

function delete_img ($id) {
    global $base_path;
    global $pdo;

    $image_path = $base_path . '/img/';
    $stmt = $pdo->prepare('SELECT * FROM images WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    unlink($image_path . $image['img_src']);
    $stmt = $pdo->prepare('DELETE FROM images WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return TRUE;
}


function save_file_arr ($file)
{
    global $base_path;
    global $pdo;

    $image_path = $base_path . '/img/';
    $count_img = count($file['name']);
    for ($i = 0; $i < $count_img; $i++){
        if ($file['error'][$i] === UPLOAD_ERR_OK){
            $filename = re_name_img($file['name'][$i]);
            if (move_uploaded_file($file['tmp_name'][$i], $image_path . $filename)){
                $stmt = $pdo->prepare('INSERT INTO images (img_src) VALUES (:img_src)');
                $stmt->execute(['img_src' => $filename]);
            }
        }
    }
    return TRUE;
}


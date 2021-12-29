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
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['text'])){
        $text = trim($_POST['text']);
        if (mb_strlen($text) > 0){
            $replay = where_db_text($text);
            if ($replay){
                $_SESSION['errors'] = "Значение уже есть в таблице";
            }else{
                $save = save_db_text($text);
                if ($save){
                    $_SESSION['message'] = "Текст: " . htmlspecialchars($text) . " успешно добавлен";
                }
            }
        }else{
            $_SESSION['errors'] = "Заполните поле";
        }
    }
    header('Location: task_9.php');
}


function save_db_text($text){
    global $pdo;
    $sql = 'INSERT INTO text (text) VALUES (:text)';
    $stmt = $pdo->prepare($sql);
    $statament = $stmt->execute(['text' => $text]);
    return $statament;
}

function where_db_text($text){
    global $pdo;
    $text = $pdo->quote($text);
    $text = strtr($text, ['_' => '\_', '%' => '\%']);
    $stmt = $pdo->query("SELECT * FROM text WHERE text LIKE $text");
    $statament = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $statament;
}

















// 1. Получить значение
// 2. Занести в кавычки
// 3. экранировать символы
// 4. Подготовить запрос
// 5. Выполнить запрос
// 6. Провека есть ли такое значение в таблице?
// 7. Вывод:  успех || провал 






// 1. Удалить пробелы
// 2. Проверить длину
// 3. Изменить символы 
// 4. Подготовить запрос
// 5. Выполнить запрос
// 6. 
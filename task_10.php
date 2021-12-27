<?php 

$user_name = 'root';
$user_pass = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=tasks', $user_name, $user_pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    exit();
}

if (isset($_POST['go'])) {
    $text = $_POST['text'];
    $err = TRUE;

    $search_text = $db->prepare('SELECT text FROM text WHERE text LIKE ?');
    $search_text->execute([$text]);
    $result = $search_text->fetchAll();
    if (count($result) > 0){
        $err = FALSE;
    }
    
    if ($err){
        $stmt = $db->prepare('INSERT INTO text (text) VALUES (?)');
        $stmt->execute([$text]);
        header('Location: http://tasks' . $_SERVER['SCRIPT_NAME'] . '?add=ok');
        exit();
    }
}
header('Content-Type: text/html');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
        <main id="js-page-content" role="main" class="page-content">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="panel-content">
                                <div class="form-group">
                                    <?php if ($err === FALSE) : ?>
                                    <div class="alert alert-danger fade show" role="alert">
                                        You should check in on some of those fields below.
                                    </div>
                                    <?php elseif (isset($_GET['add']) && $_GET['add'] == 'ok') : ?>
                                        <div class="alert fade show" role="alert">
                                        Успешно добавленно
                                    </div>
                                    <?php endif ?>
                                    <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                                        <label class="form-label" for="simpleinput">Text</label>
                                        <input type="text" id="simpleinput" class="form-control" name="text">
                                        <button class="btn btn-success mt-3" name="go">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            // default list filter
            initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
            // custom response message
            initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
        </script>
    </body>
</html>

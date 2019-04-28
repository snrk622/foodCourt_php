<?php

require_once(__DIR__ . '/../config/config.php');

//var_dump($_SESSION['me']);

$app = new MyApp\Controller\Index();

$app->run();

//$app->me();
//app->getValues()->users

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="container">
        
        
        
    </div>
    <a href="menu_list.php">メニュー一覧</a>

</body>

</html>

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
        <form action="logout.php" method="post" id="logout">
            <?= h($app->me()->email); ?><input type="submit" value="Log out">
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
        
        
    </div>
    <a href="menu_list.php">メニュー一覧</a>

</body>

</html>

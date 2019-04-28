<?php

require_once(__DIR__ . '/../config/config.php');

$menu_id = $_POST['id'];
$_SESSION['id'] = $menu_id;

$app = new \MyApp\Controller\Ticket();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="menu.css">
    <title>整理券</title>
</head>

<body>
    <h1>整理券</h1>

    
        <div class="menu">
            <h2><?= h($app->getValues()->menu->name); ?></h2>
            <img src="<?= 'images/' . h($app->getValues()->menu->img_path); ?>" class="img">
            <p><?= h($app->getValues()->menu->price); ?>円</p>
            <p><?= h($app->getValues()->menu->cal); ?>kcal</p>
        </div>



</body>

</html>
<?php 

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\Menu_list();

$app->run();

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="menu.css">
    <title>メニュー一覧</title>
</head>

<body>
    <h1>MENU</h1>

    <!--
        <div class="menu">
            <h2>ラーメン</h2>
            <div class="img red"></div>
            <p>500円</p>
            <p>800kcal</p>
            <input type="button" value="buy">
        </div>
        <div class="menu">
            <h2>唐揚げ</h2>
            <div class="img blue"></div>
            <p>400円</p>
            <p>600kcal</p>
            <input type="button" value="buy">
        </div>
        <div class="menu">
            <h2>アイス</h2>
            <div class="img green"></div>
            <p>100円</p>
            <p>200kcal</p>
            <input type="button" value="buy">
        </div>
-->
    <?php foreach ($app->getValues()->menus as $menu) : ?>
    <form action="ticket.php" method="post">
        <div class="menu">
            <input type="hidden" name="id" value="<?= h($menu->id) ?>">
            <h2><?= h($menu->name); ?></h2>
            <!--            <div class="img"></div>-->
            <img src="<?= 'images/' . h($menu->img_path); ?>" class="img">
            <p><?= h($menu->price); ?>円</p>
            <p><?= h($menu->cal); ?>kcal</p>
            <input type="submit" value="buy">
        </div>
    </form>
    <?php endforeach; ?>



</body>

</html>

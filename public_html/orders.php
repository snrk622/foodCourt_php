<?php 

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\Orders();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['done_id'] = $_POST['order_id'];
    $_SESSION['status'] = $_POST['now_status'];
    $app->done();
}


$app->run();


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="public.css">
    <link rel="stylesheet" href="order.css">
    <title>メニュー一覧</title>
</head>

<body>
    <header>
        <h1 class="title">岩手県立大学　食券販売システム ＜管理者＞</h1>

    </header>


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
    <div class="wrapper">
        <div class=" order order_wait">
            <h2>調理中</h2>
            <?php foreach ($app->getValues()->orders1 as $order) : ?>
            <form action="" method="post">
                <div class="menu">
                    <input type="hidden" name="order_id" value="<?= h($order->order_id) ?>">
                    <input type="hidden" name="now_status" value="<?= h($order->status) ?>">
                    <p class="num margin0"><?= sprintf('%03d', h($order->order_id)); ?></p>
                    <h2><?= h($order->name); ?></h2>
                    <p><?= h($order->date); ?></p>
                    <p><?= h($order->email); ?></p>
                    <input type="submit" value="done!">
                </div>
            </form>
            <?php endforeach; ?>
        </div>

        <div class="order order_go">
            <h2>受け取り待ち</h2>
            <?php foreach ($app->getValues()->orders2 as $order) : ?>
            <form action="" method="post">
                <div class="menu">
                    <input type="hidden" name="order_id" value="<?= h($order->order_id) ?>">
                    <input type="hidden" name="now_status" value="<?= h($order->status) ?>">
                    <p class="num margin0"><?= sprintf('%03d', h($order->order_id)); ?></p>
                    <h2><?= h($order->name); ?></h2>
                    <p><?= h($order->date); ?></p>
                    <p><?= h($order->email); ?></p>
                    <input type="submit" value="done!">
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>

    



</body>

</html>

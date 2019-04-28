<?php

require_once(__DIR__ . '/../config/config.php');

    $app = new \MyApp\Controller\Ticket();

$_SESSION['user_id'] = $app->me()->id;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $menu_id = $_POST['menu_id'];
    $_SESSION['menu_id'] = $menu_id;
    $app->register();
}

    
    $app->call();
    
    



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="public.css">
    <title>整理券</title>
</head>

<body>
    <header>
        <h1 class="title">岩手県立大学　食券販売システム</h1>
        <ul>
            <li><a href="menu_list.php">メニュー</a></li>
            <li class="active"><a class="active" href="#">整理券</a></li>
            <li><a href="">ホーム</a></li>
        </ul>
    </header>

    
    <?php foreach ($app->getValues()->menus as $menu) : ?>
    
    <div class="ticket-top">
        <p class="center margin0">岩手県立大学生活協同組合組合</p>
        <h1 class="univ">Univ.</h1>
        <p class="margin0">co-op</p>
        <p class="center">領収書</p>
        <p><?= h($menu->date); ?></p>
        <div class="bought">
            <p class="margin0"><?= h($menu->name); ?></p>
            <p class="margin0">¥<?= h($menu->price); ?></p>
        </div>
    </div>
    <div class="ticket-bottom">
        <div class="left">
            <p class="margin0 fs12">呼び出し番号：</p>
            <p class="num margin0"><?= sprintf('%03d', h($menu->order_id)); ?></p>
            
        </div>
        <div class="right">
        <?php if($menu->status === '2') { ?>
        <div class="icon"><img src="images/wait.png"></div>
        <div class="status wait">Wait...</div>
        <?php }elseif($menu->status === '1'){ ?>
        <div class="icon"><img src="images/go.png"></div>
        <div class="status go">Go!</div>
        <?php }else{ ?>
        <div class="icon"><img src="images/receive.png"></div>
        <div class="status eat">Done</div>
        <?php }; ?>
        </div>
    </div>
    <?php endforeach; ?>
    
    


</body>

</html>

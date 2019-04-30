<?php

require_once(__DIR__ . '/../config/config.php');

    $app = new \MyApp\Controller\Ticket();

$_SESSION['user_id'] = $app->me()->id;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['menu_id'] = $_POST['menu_id'];
    $_SESSION['menu_price'] = $_POST['menu_price'];
    $_SESSION['menu_popular'] = $_POST['menu_popular'];
    $app->register();
}

    
    $app->call();
    
    



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ticket.css">
    <link rel="stylesheet" href="public.css">
    <title>整理券</title>
</head>

<body>
    <header>
        <h1 class="title">PreTicket.</h1>
    </header>

    
    <?php foreach ($app->getValues()->menus as $menu) : ?>
    
    <div class="ticket-top">
        <p class="center margin0">岩手県立大学生活協同組合組合</p>
        <img class="receipt_logo" src="images/receipt_logo.png">
        <p class="fs12">領収書</p>
        <p class="margin0"><?= h($menu->date); ?></p>
        <div class="bought">
            <p class="margin0"><?= h(sprintf('%02d', $menu->menu_id)); ?> <?= h($menu->name); ?></p>
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
    <footer>
        
        <div class="footer_menu">
            <a href="menu_list.php" class="menu_item"><img src="images/menu.svg"></a>
            <a href="search.php" class="menu_item"><img src="images/search.svg"></a>
            <a href="ticket.php" class="menu_item menu_ticket  menu_now"><img src="images/ticket.svg"></a>
            <a href="" class="menu_item"><img src="images/cart.svg"></a>
            <a href="info.php" class="menu_item"><img src="images/wallet.svg"></a>
        </div>
    </footer>
    


</body>

</html>

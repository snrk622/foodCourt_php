<?php 

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\Info();
$app->run();


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
<!--    <link rel="stylesheet" href="menu.css">-->
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="public.css">
    <title>メニュー一覧</title>
</head>

<body>

    <header>
        <h1 class="title">PreTicket.</h1>
    </header>

    <div class="search_box">
        <input type="search" placeholder="キーワードを入力...">
    </div>    
    
    <footer>
        
        <div class="footer_menu">
            <a href="menu_list.php" class="menu_item"><img src="images/menu.svg"></a>
            <a href="search.php" class="menu_item menu_now"><img src="images/search.svg"></a>
            <a href="ticket.php" class="menu_item menu_ticket"><img src="images/ticket.svg"></a>
            <a href="" class="menu_item"><img src="images/cart.svg"></a>
            <a href="info.php" class="menu_item"><img src="images/wallet.svg"></a>
        </div>
    </footer>


</body>

</html>

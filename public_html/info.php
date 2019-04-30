<?php 

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\Info();
$app->run();



if($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $_SESSION['balance'] = $app->getValues()->card->balance;
    $_SESSION['charge'] = $_POST['charge'];
    
    $app->charge();
}


    
    
    

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <!--    <link rel="stylesheet" href="menu.css">-->
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="public.css">
    <title>メニュー一覧</title>
</head>

<body>

    <header>
        <h1 class="title">PreTicket.</h1>
    </header>

    <div class="wrapper">
        <div class="card">
            <div class="card_front">
                <div class="card_left">
                    <img src="images/card_left.png">
                </div>
                <div class="card_right">
                    <img src="images/card_right.png">
                    <div class="card_right_info">
                        <div class="info">
                            <p class="margin0 phonetic"><?= h($app->me()->first_phonetic); ?>　<?= h($app->me()->last_phonetic); ?></p>
                            <p class="margin0 fullname"><?= h($app->me()->first); ?>　<?= h($app->me()->last); ?></p>
                        </div>
                        <div class="info">
                            <p class="margin0 phonetic">組合員番号</p>
                            <p class="margin0 union_num"><?= h($app->me()->card_id1); ?> <?= h($app->me()->card_id2); ?> <?= h($app->me()->card_id3); ?></p>
                        </div>
                        <div class="info">
                            <p class="margin0 min">岩手県立大学生活協同組合</p>
                            <p class="margin0 min">TEL. 019-688-9571</p>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card_back">
                <h1>組合員証</h1>
                <img src="images/barcode.png">

            </div>
        </div>


    </div>
    <div class="card_info">
        <div class="balance">
            <p>¥<?= h($app->getValues()->card->balance); ?></p>
        </div>
        <form action="" method="post" class="charge_form">
            <input type="text" name="charge" placeholder="金額">
            <input type="submit" value="チャージ">
        </form>
    </div>


    <form action="logout.php" method="post" id="logout">
        <input type="submit" value="Log out">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>


    <footer>
        <div class="footer_menu">
            <a href="menu_list.php" class="menu_item"><img src="images/menu.svg"></a>
            <a href="search.php" class="menu_item"><img src="images/search.svg"></a>
            <a href="ticket.php" class="menu_item menu_ticket"><img src="images/ticket.svg"></a>
            <a href="" class="menu_item"><img src="images/cart.svg"></a>
            <a href="info.php" class="menu_item menu_now"><img src="images/wallet.svg"></a>
        </div>
    </footer>


</body>

</html>

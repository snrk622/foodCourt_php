<?php 

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\Menu_list();
$rank = 0;


//$_SESSION['cart'] = [];
//if($_SERVER["REQUEST_METHOD"] === "POST") {
    
    
    
//}else{
    
//}

//var_dump($app->getValues()->carts);
//exit;
$app->run();

$_SESSION['card_id'] = $app->me()->card_id;
$_SESSION['balance'] = $app->getValues()->card->balance;


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="public.css">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <title>メニュー一覧</title>
</head>

<body>

    <header>
        <h1 class="title">PreTicket.</h1>
    </header>


    <!--
    <form action="" method="post">
       <?php if(isset($_SESSION['search'])) {?>
        <input type="search" name="search" value="<?= $_SESSION['search'] ?>">
        <?php }else{ ?>
        <input type="search" name="search" value="">
        <?php } ?>
        <input type="submit" value="検索">
    </form>
    <form action="" method="post">
        <input type="hidden" name="search" value="">
        <input type="submit" value="リセット">
    </form>
-->
    <!--
    <form action="" method="post">
                <input type="hidden" name="genre_id" value="">
        <input type="submit" value="すべて">
    </form>
    <?php foreach ($app->getValues()->genres as $genre) : ?>
    <form action="" method="post">
        <input type="hidden" name="genre_id" value="<?= h($genre->id); ?>">
        <input type="submit" value="<?= h($genre->name); ?>">
    </form>
    <?php endforeach; ?>
-->



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
        <div class="tag ranking"><img src="images/ranking.png">
            <h2>TOP3</h2>
        </div>
        <div class="genre">
            <?php foreach ($app->getValues()->ranking as $ranking) : ?>
            <form action="ticket.php" method="post" class="menu">

                <input type="hidden" name="menu_id" value="<?= h($ranking->id) ?>">
                <input type="hidden" name="menu_price" value="<?= h($ranking->price) ?>">
                <input type="hidden" name="menu_popular" value="<?= h($ranking->popular) ?>">
                <div class="rank_img">
                    <img class="img" src="<?= 'images/' . h($ranking->img_path); ?>">
                    <?php if ($rank === 1) { ?>
                    <img class="rank_icon" src="images/gold.png">
                    <?php }elseif ($rank === 2) { ?>
                    <img class="rank_icon" src="images/silver.png">
                    <?php }else{ ?>
                    <img class="rank_icon" src="images/bronze.png">
                    <?php }; ?>
                    <?php $rank ++; ?>
                </div>
                <p class="menu_name"><?= h($ranking->name); ?></p>
                <p class="menu_price <?= $ranking->price <= $_SESSION['balance'] ? "green" : "red"; ?>">¥<?= h($ranking->price); ?></p>
                <input type="submit" value="buy" <?= $ranking->price <= $_SESSION['balance'] ? "" : "disabled"; ?>>
            </form>
            <?php endforeach; ?>
        </div>
        <div class="tag"><img src="images/tag.png">
            <h2>ごはん</h2>
        </div>
        <div class="genre">
            <?php foreach ($app->getValues()->menu1 as $menu) : ?>
            <form action="ticket.php" method="post" class="menu">
                <input type="hidden" name="menu_id" value="<?= h($menu->id) ?>">
                <input type="hidden" name="menu_price" value="<?= h($menu->price) ?>">
                <input type="hidden" name="menu_popular" value="<?= h($menu->popular) ?>">
                <img class="img" src="<?= 'images/' . h($menu->img_path); ?>">
                <p class="menu_name"><?= h($menu->name); ?></p>
                <p class="menu_price <?= $menu->price <= $_SESSION['balance'] ? "green" : "red"; ?>">¥<?= h($menu->price); ?></p>
                <input type="submit" value="buy" <?= $menu->price <= $_SESSION['balance'] ? "" : "disabled"; ?>>
            </form>
            <?php endforeach; ?>
        </div>
        <div class="tag"><img src="images/tag.png">
            <h2>めん</h2>
        </div>
        <div class="genre">
            <?php foreach ($app->getValues()->menu2 as $menu) : ?>
            <form action="ticket.php" method="post" class="menu">
                <input type="hidden" name="menu_id" value="<?= h($menu->id) ?>">
                <input type="hidden" name="menu_price" value="<?= h($menu->price) ?>">
                <input type="hidden" name="menu_popular" value="<?= h($menu->popular) ?>">
                <img class="img" src="<?= 'images/' . h($menu->img_path); ?>">
                <p class="menu_name"><?= h($menu->name); ?></p>
                <p class="menu_price <?= $menu->price <= $_SESSION['balance'] ? "green" : "red"; ?>">¥<?= h($menu->price); ?></p>
                <input type="submit" value="buy" <?= $menu->price <= $_SESSION['balance'] ? "" : "disabled"; ?>>
            </form>
            <?php endforeach; ?>
        </div>








    </div>


    <footer>

        <div class="footer_menu">
            <a href="menu_list.php" class="menu_item menu_now"><img src="images/menu.svg"></a>
            <a href="search.php" class="menu_item"><img src="images/search.svg"></a>
            <a href="ticket.php" class="menu_item menu_ticket"><img src="images/ticket.svg"></a>
            <a href="" class="menu_item"><img src="images/cart.svg"></a>
            <a href="info.php" class="menu_item"><img src="images/wallet.svg"></a>
        </div>
    </footer>








</body>

</html>

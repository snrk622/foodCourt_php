<?php 

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\Menu_list();


//$_SESSION['cart'] = [];
//if($_SERVER["REQUEST_METHOD"] === "POST") {
    
    
    
//}else{
    
//}

//var_dump($app->getValues()->carts);
//exit;
$app->run();




?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="public.css">
    <title>メニュー一覧</title>
</head>

<body>
    
    <header>
        <h1 class="title">PreTicket.</h1>
    </header>
    
    <form action="logout.php" method="post" id="logout">
        <?= h($app->me()->email); ?><input type="submit" value="Log out">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
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
    <?php foreach ($app->getValues()->menus as $menu) : ?>
    <form action="ticket.php" method="post" class="menu">
            <input type="hidden" name="menu_id" value="<?= h($menu->id) ?>">
<!--            <input type="hidden" name="cart" value="<?= h($menu->id) ?>">-->
            <h2><?= h($menu->name); ?></h2>
            <!--            <div class="img"></div>-->
            <img src="<?= 'images/' . h($menu->img_path); ?>" class="img">
            <p><?= h($menu->price); ?>円</p>
            <p><?= h($menu->cal); ?>kcal</p>
            <input type="submit" value="buy">
    </form>
    <?php endforeach; ?>
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

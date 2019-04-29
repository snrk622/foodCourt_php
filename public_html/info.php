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
               <div class="notice">
                   <p class="margin0">●本証は生協利用の際、提示を必要とされている場合は、必ず提示してください。提示がない場合は、組合員証提示割引を受けられないことがあります。</p>
                <p class="margin0">●本証は他人に貸与したり、または譲渡したりすることはできない。</p>
                <p class="margin0">●本証を紛失した時は届け出て再交付を受け、定められた手数料を納付してください。</p>
                <p class="margin0">●住所・所属・休学その他変更が生じた場合は必ず届け出てください。</p>
                <p class="margin0">●卒業・退職等により組合員の資格を喪失した時は、直ちに本証を返納してください。</p>
                <p class="margin0">●自由意志で脱退する時は、90日前に組合に届けを出し、事業年度の終わりに脱退することができます。</p>
               </div>
                
            </div>
        </div>
        

    </div>
    
    
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

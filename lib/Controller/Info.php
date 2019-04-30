<?php  

namespace MyApp\Controller;

class Info extends \MyApp\Controller {
    
    public function run() {
        $userModel = new \MyApp\Model\User();
        $this->setValues('card', $userModel->cardInfo($_SESSION['card_id']));
        
    }
    
    public function charge() {
        $userModel = new \MyApp\Model\User();
        $this->setValues('charge', $userModel->charge($_SESSION['charge'], $_SESSION['card_id'], $_SESSION['balance']));
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
    
    
}


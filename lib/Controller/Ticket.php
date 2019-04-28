<?php  

namespace MyApp\Controller;



class Ticket extends \MyApp\Controller {
    
    
    
    public function call() {
        $userModel = new \MyApp\Model\MenuModel();
        
        $this->setValues('menus', $userModel->findId($_SESSION['user_id']));
    }  
    
    public function register() {
        $userModel = new \MyApp\Model\MenuModel();
        $userModel->registerOrder($_SESSION['menu_id'], $_SESSION['user_id']);
        header('Location: ' . $_SERVER['PHP_SELF']);
        
    }
}


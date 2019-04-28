<?php  

namespace MyApp\Controller;



class Ticket extends \MyApp\Controller {
    
    public function run() {
//        if(!$this->isLoggedIn()) {
//            //login画面へ遷移
//            header('Location: ' . SITE_URL . '/login.php');
//            exit;
//        }
        
        //get users info
        $userModel = new \MyApp\Model\MenuModel();
        $this->setValues('menu', $userModel->findId($_SESSION['id']));
    }    
}


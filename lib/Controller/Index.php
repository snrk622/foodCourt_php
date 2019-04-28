<?php  

namespace MyApp\Controller;

class Index extends \MyApp\Controller {
    
    public function run() {
        if(!$this->isLoggedIn()) {
            //login画面へ遷移
            header('Location: ' . SITE_URL . '/login.php');
            exit;
        }
        
        //get users info
        $userModel = new \MyApp\Model\User();
        $this->setValues('users', $userModel->findAll());
        header('Location: ' . SITE_URL . '/menu_list.php');
        exit;
    }    
}

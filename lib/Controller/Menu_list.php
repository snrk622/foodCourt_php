<?php  

namespace MyApp\Controller;

class Menu_list extends \MyApp\Controller {
    
    public function run() {
        $userModel = new \MyApp\Model\MenuModel();
        $user = new \MyApp\Model\User();
        $this->setValues('ranking', $userModel->ranking());
        $this->setValues('menu1', $userModel->findAll(1));
        $this->setValues('menu2', $userModel->findAll(2));
        $this->setValues('genres', $userModel->findGenre());
        $this->setValues('card', $user->cardInfo($_SESSION['card_id']));
    }  
    
    public function post() {
        $userModel = new \MyApp\Model\MenuModel();
        $this->setValues('menus', $userModel->findGenreMenu($_SESSION['genre'], $_SESSION['search']));
        $this->setValues('genres', $userModel->findGenre());
    }  
    
    public function search() {
        $userModel = new \MyApp\Model\MenuModel();
        $this->setValues('search', $userModel->menuSearch($_SESSION['search']));
    }
}


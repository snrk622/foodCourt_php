<?php  

namespace MyApp\Controller;

class Menu_list extends \MyApp\Controller {
    
    public function run() {
        $userModel = new \MyApp\Model\MenuModel();
        $this->setValues('menus', $userModel->findAll($_SESSION['search']));
        $this->setValues('genres', $userModel->findGenre());
        
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


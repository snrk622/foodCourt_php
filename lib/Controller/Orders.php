<?php  

namespace MyApp\Controller;

class Orders extends \MyApp\Controller {
    
    public function run() {

        $userModel = new \MyApp\Model\MenuModel();
        $this->setValues('orders1', $userModel->findWaitOrders());
        $this->setValues('orders2', $userModel->findGoOrders());
    }    
    
    public function done() {
        $userModel = new \MyApp\Model\MenuModel();
        $userModel->status($_SESSION['done_id'], $_SESSION['status']);
    }
}


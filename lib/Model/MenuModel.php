<?php

namespace MyApp\Model;

class MenuModel extends \MyApp\Model {
    
    
    public function findAll($search) {
        if(isset($_SESSION['genre'])) {
            
        }
        $stmt = $this->db->prepare("select 
        * from menu where name like :search;");
        $stmt->execute([
           ':search' =>  '%' . $search . '%'
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function findGenre() {
        $stmt = $this->db->query("select 
        * from genre order by id;");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function menuSearch() {
        $stmt = $this->db->prepare("select 
        * from menu where genre = :genre order by id;");
        $stmt->execute([
           ':genre' =>  $genre_id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function findGenreMenu($genre_id, $search) {
        $stmt = $this->db->prepare("select * from menu where genre = :genre and name like :search;");
        $stmt->execute([
            ':genre' =>  $genre_id,
            ':search' =>  '%' . $search . '%'
            ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function registerOrder($menu_id, $user_id) {
        $date = new \DateTime('now');
        $stmt = $this->db->prepare("insert into orders (menu_id, user_id, date) values (:menu_id, :user_id, :date);");
        $res = $stmt->execute([
            ':menu_id' => $menu_id,
            ':user_id' => $user_id,
            ':date' => $date->format('Y-m-d H:i:s')
        ]);
        
        if($res === false) {
            throw new \MyApp\Exception\DuplicateEmail();
        }
    }
    
    public function findId($user_id) {
        $stmt = $this->db->prepare("select orders.id as order_id, date, menu_id, user_id, status, name, price, cal, img_path, genre, email from orders join menu on (orders.menu_id = menu.id) join users on (orders.user_id = users.id) where user_id = :id order by status;");
        $stmt->execute([
            ':id' => $user_id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function findWaitOrders() {
        $stmt = $this->db->query("select orders.id as order_id, date, menu_id, user_id, status, name, email from orders join menu on (orders.menu_id = menu.id) join users on (orders.user_id = users.id) where status = 2 order by orders.id ;");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function findGoOrders() {
        $stmt = $this->db->query("select orders.id as order_id, date, menu_id, user_id, status, name, email from orders join menu on (orders.menu_id = menu.id) join users on (orders.user_id = users.id) where status = 1 order by orders.id ;");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function status($order_id, $status) {
        if($status === '2'){
            $stmt = $this->db->prepare("update orders set status = 1 where id = :id;");
        } elseif($status === '1'){
            $stmt = $this->db->prepare("update orders set status = 3 where id = :id;");
        }
        
        $stmt->execute([
            ':id' => $order_id
        ]);
        
    }
    
}
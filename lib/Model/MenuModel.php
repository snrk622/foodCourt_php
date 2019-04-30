<?php

namespace MyApp\Model;

class MenuModel extends \MyApp\Model {
    
    
    public function findAll($genre) {
        $stmt = $this->db->prepare("select 
        * from menu where genre = :genre;");
        $stmt->execute([
           ':genre' =>  $genre
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function ranking() {
        $stmt = $this->db->query("select * from menu where popular > 0 order by popular desc limit 3;");
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
    
    public function registerOrder($menu_id, $user_id, $card_id, $menu_price, $balance, $popular) {
        $date = new \DateTime('now');
        $stmt1 = $this->db->prepare("insert into orders (menu_id, user_id, date) values (:menu_id, :user_id, now());");
        $res1 = $stmt1->execute([
            ':menu_id' => $menu_id,
            ':user_id' => $user_id
        ]);
        $stmt2 = $this->db->prepare("update card set balance = :balance where id = :card_id;");
        $res2 = $stmt2->execute([
            ':card_id' =>  $card_id,
            ':balance' =>  $balance - $menu_price
        ]);
        
        $stmt3 = $this->db->prepare("update menu set popular = :popular where id = :menu_id;");
        $res3 = $stmt3->execute([
            ':popular' => $popular + 1,
            ':menu_id' => $menu_id
        ]);
        
        if($res1 === false || $res2 === false) {
            throw new \MyApp\Exception\DuplicateEmail();
        }
    }
    
    public function findId($user_id) {
        $stmt = $this->db->prepare("select orders.id as order_id, date, menu_id, user_id, status, name, price, cal, img_path, genre, email from orders join menu on (orders.menu_id = menu.id) join users on (orders.user_id = users.id) where user_id = :id order by status, order_id;");
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
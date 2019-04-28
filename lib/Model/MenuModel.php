<?php

namespace MyApp\Model;

class MenuModel extends \MyApp\Model {
    
    
    public function findAll() {
        $stmt = $this->db->query("select 
        * from menu order by id");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function findId($id) {
        $stmt = $this->db->prepare("select 
        * from menu where id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetch();
    }
    
}
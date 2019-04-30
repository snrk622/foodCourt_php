<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
    public function create($values) {
        $stmt1 = $this->db->prepare("insert into users (email, password, created, modified, first_phonetic, last_phonetic, first, last, card_id1, card_id2, card_id3, card_id) values (:email, :password, now(), now(), :first_phonetic, :last_phonetic, :first, :last, :card_id1, :card_id2, :card_id3, :card_id)");
        $res1 = $stmt1->execute([
            ':email' => $values['email'],
            ':password' => password_hash($values['password'], PASSWORD_DEFAULT),
            ':first_phonetic' => $values['first_phonetic'],
            ':last_phonetic' => $values['last_phonetic'],
            ':first' => $values['first'],
            ':last' => $values['last'],
            ':card_id1' => $values['card_id1'],
            ':card_id2' => $values['card_id2'],
            ':card_id3' => $values['card_id3'],
            ':card_id' => $values['card_id1'] . $values['card_id2'] . $values['card_id3']
        ]);
        
        $stmt2 = $this->db->prepare("insert into card (id) values (:card_id);");
        $res2 = $stmt2->execute([
            ':card_id' => $values['card_id1'] . $values['card_id2'] . $values['card_id3']
        ]);
        
        if($res1 === false || $res2 === false) {
            throw new \MyApp\Exception\DuplicateEmail();
        }
    }
    
    public function login($values) {
        $stmt = $this->db->prepare("select 
        * from users where email = :email");
        $stmt->execute([
            ':email' => $values['email']
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $user = $stmt->fetch();
        
        if(empty($user)){
            throw new \MyApp\Exception\UnmatchEmailOrPassword();
        }
        
        if(!password_verify($values['password'], $user->password)){
            throw new \MyApp\Exception\UnmatchEmailOrPassword();
        }
        
        return $user;
    }
    
    public function findAll() {
        $stmt = $this->db->query("select 
        * from users order by id");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
    
    public function cardInfo($card_id) {
//        var_dump($card_id);
        $stmt = $this->db->prepare("select 
        * from card where id = :card_id");
        $stmt->execute([
            ':card_id' => $card_id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetch();
    }
    
    public function charge($charge, $card_id, $balance) {
//        var_dump($card_id);
        $stmt = $this->db->prepare("update card set balance = :charge where id = :card_id;");
        $stmt->execute([
            ':charge' => $balance + $charge,
            ':card_id' => $card_id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetch();
    }
    
}
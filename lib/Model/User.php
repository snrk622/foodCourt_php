<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
    public function create($values) {
        $stmt = $this->db->prepare("insert into users (email, password, created, modified, first_phonetic, last_phonetic, first, last, card_id1, card_id2, card_id3) values (:email, :password, now(), now(), :first_phonetic, :last_phonetic, :first, :last, :card_id1, :card_id2, :card_id3)");
        $res = $stmt->execute([
            ':email' => $values['email'],
            ':password' => password_hash($values['password'], PASSWORD_DEFAULT),
            ':first_phonetic' => $values['first_phonetic'],
            ':last_phonetic' => $values['last_phonetic'],
            ':first' => $values['first'],
            ':last' => $values['last'],
            ':card_id1' => $values['card_id1'],
            ':card_id2' => $values['card_id2'],
            ':card_id3' => $values['card_id3'],
        ]);
        
        if($res === false) {
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
    
    
}
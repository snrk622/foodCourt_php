<?php  

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {
    
    public function run() {
        if($this->isLoggedIn()) {
            header('Location: ' . SITE_URL);
            exit;
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postProcess();
        }
    } 
    
    protected function postProcess() {
        //validate
        try {
            $this->_validate();
        } catch(\MyApp\Exception\InvalidEmail $e) {
//            echo $e->getMessage();
//            exit;
            $this->setErrors('email', $e->getMessage());
        } catch(\MyApp\Exception\InvalidPassword $e) {
//            echo $e->getMessage();
//            exit;
            $this->setErrors('password', $e->getMessage());
        }

//        echo "success";
//        exit;
        
        $this->setValues('email', $_POST['email']);
        
        if($this->hasError()) {
            return;
        } else {
            //create user 
        try {
            $userModel = new \MyApp\Model\User();
            $userModel->create([
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'first_phonetic' => $_POST['first_phonetic'],
                'last_phonetic' => $_POST['last_phonetic'],
                'first' => $_POST['first'],
                'last' => $_POST['last'],
                'card_id1' => $_POST['card_id1'],
                'card_id2' => $_POST['card_id2'],
                'card_id3' => $_POST['card_id3'],
             ]);
        }catch(\MyApp\Exception\DuplicateEmail $e) {
            $this->setErrors('email', $e->getMessage());
            return;
        }
            
            //redirect to login
            header('Location: ' . SITE_URL . '/login.php');
            exit;
        }
        
        
    }
    
    private function _validate(){
        if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
            echo "Invalid Token!";
            exit;
        }
    
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
           throw new \MyApp\Exception\InvalidEmail();
        }
        
        if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
           throw new \MyApp\Exception\InvalidPassword();
        }
        
        if(!preg_match('/\A\d{4}\z/', $_POST['card_id1']) || !preg_match('/\A\d{4}\z/', $_POST['card_id2']) || !preg_match('/\A\d{4}\z/', $_POST['card_id3'])) {
            throw new \MyApp\Exception\InvalidEmail();
        }
        
        if(!isset($_POST['first']) || !isset($_POST['last']) || !isset($_POST['first_phonetic']) || !isset($_POST['last_phonetic'])){
            throw new \MyApp\Exception\InvalidEmail();
        }
    }
    
}

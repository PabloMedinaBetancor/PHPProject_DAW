<?php 

class User {
    public $loggedIn;
    public $name;
    function __construct(){
        $this->name="undefined";
        $this->loggedIn=false;
    }
    function isLoggedIn(){
        return $this->loggedIn;
    }
    function logIn(){
        $this->loggedIn=true;
    }
}

class Users{
    static function loadUser($n){
        $r=new User();
        $r->name=$n;
        $r->logIn();
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION["user"]=$r;
        return $r;
    }
    static function createUser($n,$HP,$cookiepass){ //given name and hashedpassword, save on database and create new user
        Database::addUser($n,$HP,$cookiepass);
        self::loadUser($n);
    }
}

?>
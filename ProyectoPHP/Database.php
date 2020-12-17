<?php

class Database{
    static $PQ=[]; //prepared queries
    static function initDB($config){ 
        $cn=new PDO("mysql:host=localhost;dbname=PHPPROJECT", $config["DB"]["username"], "");
      //  $config["DB"]["password"]); 
        $cn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);       
        $cn->exec("CREATE DATABASE IF NOT EXISTS PHPPROJECT;");
        $cn->exec("CREATE TABLE IF NOT EXISTS Users (username varchar(45) primary key, passwordhash varchar(9999), cookiepass varchar(9999);");
        $cn->exec("CREATE TABLE IF NOT EXISTS Images (ownedBy varchar(80),position varchar(200),foreign key(ownedBy) references Users(username));");
        self::$PQ=[$cn->prepare("insert into Users (username,passwordhash,cookiepass) values(:username,:pass,:cookiepass);"),
            $cn->prepare("insert into Images (ownedBy,position) values(:ownedBy,:position);"),
            $cn->prepare("select count(ownedBy) from Images as I, Users as U where ownedBy=username and username= :name;"),
            $cn->prepare("select count(username) from Users where username= :name);"),
            $cn->prepare("select count(username) from Users where username= :name and passwordhash= :passwordhash);"),
            $cn->prepare("select username from Users where cookiepass= any(:cookiepass));"),
            $cn->prepare("select cookiepass from Users where username= :username;")
        ];
    }
    static function addUser($username,$passwordhash,$cookiepass){
        self::$PQ[0]->execute([":username"=>$username,":pass"=>$passwordhash, ":cookiepass" => $cookiepass]);
    }
    static function addImg($location){
        self::$PQ[1]->execute([":ownedBy"=>$_SESSION["user"]->name,":position"=>$location]);
    }
    static function getNumImgForUser($u){
        return self::$PQ[2]->execute([":name"=>$u]);
    }
    static function userIsSet($u){
        return self::$PQ[3]->execute([":name"=>$u])===1;
    }
    static function userPasswordIsSet($u,$p){
        return self::$PQ[4]->execute([":name"=>$u,":passwordhash"=>$u])===1;
    }
    static function matchCookieWithUsersCookiePass(){
        return self::$PQ[5]->execute([":cookiepass"=>array_keys($_COOKIE)]);
    }
    static function getCookiePassThruUsername($username){
        return self::$PQ[6]->execute([":username"=>$username]);
    }
}
Database::initDB($config);


?>
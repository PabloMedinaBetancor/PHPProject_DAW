<?php
class Portfolio {
    static function showImg($position,$name){ 
        $ID=$name+$position;
        $category=$_SESSION["user"]->name+"'s project";
        $name=strval($ID);
        include "../views/index_portfolio.php";
    }
    static function showUserPortfolio($n){
        $NI=Database::getNumImgForUser($n);
        for($i=0;$i<$NI; $i++){
            self::showImg($i,$n);
       }
    }
    static function showPortfolio(){
        if($_SESSION["user"]->isLoggedIn()){
            self::showUserPortfolio($_SESSION["user"]->name);
        }
        include "uploadImg.php";
    }
}
?>
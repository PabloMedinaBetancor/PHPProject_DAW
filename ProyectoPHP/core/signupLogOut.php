
<?php 
include "../views/singupLogOut_views.php";  

class HASH {
    static function HashByConfig($s,$config){
        return hash($config["HASH"]["Algorithm"],$s+$config["HASH"]["salt"]);
    }
}
class Signup{
    static function checkSignUp($config){
        //If signup form has been submited: Check if Username matches password. if the session has no accounts, create one.
        if(Form::Post("done")==="submited"){
            $U=Form::Post("Username");
            $P=Form::Post("pass");
            $HP=HASH::HashByConfig($P,$config);
            if(Database::userPasswordIsSet($U,$HP)){
                Users::loadUser($U);
            }
            else{
                if(!Database::userIsSet($U)){
                    $cookiepass=HASH::HashByConfig($U+$HP+strval(rand(0,9999999)),$config);
                    setcookie($cookiepass," ", 3600000);
                    Users::createUser($U,$HP,$cookiepass);
                }
            }
        }
        else{
            $username=Database::matchCookieWithUsersCookiePass();
            if(!($username===false)){
                Users::loadUser($username);
            }
        }
        Routes::Redirect("index.php");       
    }
}
class LogOut{
    static function checkLogOut(){ 
        if(!(Form::Post("logOut")===false)){
            setcookie(Database::getCookiePassThruUsername($_SESSION["user"]->name),"",time()-3600);
            $_SESSION=array();
            session_destroy();
            Routes::Redirect("index.php");
        }
    }
}

?>



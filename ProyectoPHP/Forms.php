<?php

class Form{
    static function Post($n){
        $r=false;
        if($_POST[$n]!==null){
            $r=htmlspecialchars($_POST[$n]);
        }
        return $r;
    }
    static function moveFile($location){ //Moves Uploaded files to specified directitory if there are any, if not returns false
        $r=false;
        if(is_uploaded_file($_FILES["tmp_name"])){
            move_uploaded_file($_FILES["tmp_name"],$location);
            $r=true;
        }
        return $r;
    }
}

?>
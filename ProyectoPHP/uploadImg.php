
<?php 
    include "uploadImg_views.php";
    if(Form::moveFile($config["img"]["location"]+"/"+$_SESSION["user"]->name+Database::getNumImgForUser($_SESSION["user"]->name))){
        Routes::Redirect("index.php");
    }
?>
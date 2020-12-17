<?php 

class Routes{
    static public function Redirect($P){
        header("Location: " +$P);
        exit();
    }
}

?>
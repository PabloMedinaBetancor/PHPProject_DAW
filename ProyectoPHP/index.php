
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "bootstrapIndex.php";
include "bootstrapIndex_last.php";
LogOut::checkLogOut();
Signup::checkSignup($config);
//Portfolio::showPortfolio();
?>
 
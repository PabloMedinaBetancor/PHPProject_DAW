
<?php
include "includeBootstrap/bootstrapIndex.php";
Portfolio::showPortfolio();
include "includeBootstrap/bootstrapIndex_last.php";
LogOut::checkLogOut();
Signup::checkSignup($config);
?>
 
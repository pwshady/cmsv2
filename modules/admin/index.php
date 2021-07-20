<?php
print("rr");
include "settings.php";
//Login to the admin panel.
if(!isset($_SESSION["admin"])){
    include dirname(__FILE__) . "\admin-login.php";
    exit();
}


print($_SESSION["admin"]);
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
print($_SERVER["REQUEST_URI"]);
require_once "app\lib\Database.php";
require_once "app\lib\Router.php";
use app\lib\database;
use app\lib\router;
session_start();

$db = new Database("app/config/db-config.php");
$model = null;
$_SESSION["user"] = 1;

if(is_null($db)){
    //require_once ""
    print("error db");
}else{
    if(isset($_SESSION["admin"])){
        $model = $db->getTableAccess("admin_modules", $_SESSION["admin"]);
    }else{
        if(!isset($_SESSION['user'])){
            $_SESSION["user"] = 0;
        }
        $model = $db->getTableAccess("basic_menu", $_SESSION["user"]);
    }
    $router = new Router($model);
    for ($i = 0; $i < count($model); $i++){
        //print_r("<p>" . $model[$i]["url"] . "</p>");
    };
    //return $content;
}

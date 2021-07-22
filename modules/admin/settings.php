<?php
//Load settings
$settings = $GLOBALS["db"]->getTable("admin_settings");
foreach ($settings as $key => $value)
{
    switch ($value["operation"]){
        case 1: //Creates a session from $value["name"] by separator: "=".
            $pieces = explode("=", $value["name"]);
            if(count($pieces) == 2){
                print(count($pieces));
                $_SESSION[$pieces[0]] = $pieces[1];
            }
            break;
        case 2:
            print("<p>include</p>");
            break;
    }
}

//Connecting a language pack.
$languageDirect = $GLOBALS["db"]->getRowByKey("admin_language", "number", $_SESSION["adminLanguage"])["url"];
include $languageDirect . "name-variable.php";


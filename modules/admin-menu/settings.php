<?php
//Load settings
$settings = $GLOBALS["db"]->getTable("admin_menu_settings");
foreach ($settings as $key => $value)
{
    switch ($value["operation"]){
        case 1: //Creates a session from $value["text"] by separator: "=".
            $pieces = explode("=", $value["text"]);
            if(count($pieces) == 2){
                print(count($pieces));
                $_SESSION[$pieces[0]] = $pieces[1];
            }
            break;
        case 2: //Includes file with path $value["text"].
            include $value['text'];
            break;
    }
}
//Connecting a language pack.
$languageDirect = $GLOBALS["db"]->getRowByKey("admin_language", "number", $_SESSION["adminLanguage"])["url"];
include $languageDirect . "name-variable.php";

<?php

print("128500");
print($_SESSION["admin"]);
$modulesMenuStructure =  $GLOBALS["db"]->getTableAccess("admin_menu_structure", $_SESSION["admin"]);
print(count($modulesMenuStructure));
for ($i = 0; $i < count($modulesMenuStructure); $i++){
    print("<p>");
    print_r($modulesMenuStructure[$i]);
    print("</p>");
};




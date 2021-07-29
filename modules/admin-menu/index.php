<?php

include "settings.php";
print($_SESSION["admin"]);
print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "add-directory.php";
    exit();}
$modulesMenuStructure =  $GLOBALS["db"]->getTableAccess("admin_menu_structure", $_SESSION["admin"]);
print(count($modulesMenuStructure));

print_r($_SERVER['SCRIPT_FILENAME']);


//Test
$modulesMenuStructure =  $GLOBALS["db"]->getTable("admin_menu");

$menu = [];

for ($i = 0; $i < count($modulesMenuStructure); $i++){
    $menu[$modulesMenuStructure[$i]['number']] = $modulesMenuStructure[$i];
}


//Функция построения дерева из массива
function getTree($dataset) {
    $tree = array();

    foreach ($dataset as $id => &$node) {    
        //Если нет вложений
        if (!$node['parent']){
            $tree[$id] = &$node;
        }else{ 
            //Если есть потомки то перебераем массив
            $dataset[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}

$tree = getTree($menu);

//Шаблон для вывода меню в виде дерева
function tplMenu($category, $level, $nameVariable){
    if($category['url'] == ""){
        $menu = '<li> Cat-' . $level . '<a href="' . $category['url'] . '" title="'. $category['title'] .'">'. $category['title']. '</a>' . PHP_EOL;        
            if(isset($category['childs'])){
                $addDirectoryText = "adminMenuAddDirectory('" . $category['number'] . "', '"
                 . $nameVariable['nameAddDirectoryText'] . "', '" 
                 . $nameVariable['nameAddDirectoryTextError'] . "', '" 
                 . $nameVariable['nameAddDirectoryTextCreate'] . "', '" 
                 . $nameVariable['nameAddDirectoryText'] . "')";
                $menu .= '<ul>'. showCat($category['childs'], $level + 1, $nameVariable) .'<li><button onclick="' . $addDirectoryText . '">' . $nameVariable['nameAddDirectory'] . '</button></li></ul>' . PHP_EOL;
        }
        $menu .= '</li>' . PHP_EOL;
    }else{
        $menu = '<li><div class="admin-menu-modul" name="' . $category['url'] . '">' . $category['title'] .'</div></li>' . PHP_EOL;
    }
    return $menu;
}

/**
* Рекурсивно считываем наш шаблон
**/
function showCat($data, $level, $nameVariable){
    $string = '';
    foreach($data as $item){
        $string .= tplMenu($item, $level, $nameVariable);
    }
    return $string;
}

//Получаем HTML разметку
$cat_menu = showCat($tree, 0, $nameVariable);


?>
<body class="admin-menu-page-body">
    <div class="admin-menu-content">
        <section class="admin-menu-left">
             <?=$cat_menu?>
        </section>
        <section class="admin-menu-center">
            2
        </section>
    </div>
</body>
<footer class="admin-menu-footer">
    pwshady@gmail.com
</footer>



<?php
//Load settings
$settings = $GLOBALS['db']->getTable('admin_menu_style_settings');
foreach ($settings as $key => $value)
{
    switch ($value['operation']){
        case 4: //Includes css file with path $value["text"].
            print('<link rel="stylesheet" href="' . $value['text'] . '">');
            break;
        case 5: //Includes js file with path $value["text"].
            print('<script src="' . $value['text'] . '"></script>');
            break;
    }
}

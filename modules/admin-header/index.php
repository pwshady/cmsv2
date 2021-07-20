<?php
//Exit the admin panel.
if (isset($_POST["login_admin"]) && ($_POST["login_admin"] == "")){
    print("1");
    unset($_SESSION["admin"]);
    header ('Location: /admin/');
    exit();
}

$language = $GLOBALS["db"]->getKeyValue("admin_header_language", "name", "number");
print_r($language);
print("<p></p>");
//Load settings
$settings = $GLOBALS["db"]->getTable("admin_header_settings");
foreach ($settings as $key => $value)
{
    switch ($value["operation"]){
        case 1: //Creates a session from $value["name"] by separator: "="
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
print_r($_SESSION);
//print_r($settings);


?>
<script>
function yesOrNo()
{
var result = confirm("Сделайте выбор!");
if (result ==true)
{
alert("Вы нажали Да!");
}
else
{
alert("Вы нажали Отмена!");
}
return false;
}
</script>
<a href="#" onClick="yesOrNo();">Да или Отмена?</a>
<form action="/admin/" method="post">
    <p><button type="submit" name="login_admin">Exit</button></p>
</form>
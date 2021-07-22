<?php
print("<p><b>admin</b><p>");
print_r($_POST);
if (isset($_POST["login_admin"]) && isset($_POST["pass_admin"])){
    $accessLevel = $GLOBALS["db"]->getAccessLevel("admin_access", $_POST["login_admin"], $_POST["pass_admin"]);
    if ($accessLevel == 0){
        print("<p style='color:#ff0000' align=center>" . $nameAdminLoginAccessDenied . "</p>");
    }else{
        $_SESSION["admin"] = $accessLevel;
        header ('Location: admin/');
        exit();
    }
};
print($_SERVER["REMOTE_ADDR"]);
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    print("post--------------");
};
?>
<body>
    <div>
        <form action="/admin" method="post">
            <p><?=$nameAdminLoginLogin?><input type="text" name="login_admin"></p>
            <p><?=$nameAdminLoginPass?><input type="password" name="pass_admin"></p>
            <p><button type="submit"><?=$nameAdminLoginEnter?></button></p>
        </form>
    </div>
</body>
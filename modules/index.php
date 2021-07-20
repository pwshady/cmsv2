<?php
print("<p>Basic</p>");
if((substr($_SERVER["REQUEST_URI"],1,5)) == "admin"){
    include dirname(__FILE__) . "\admin\index.php";
    print("<p><b>admin</b><p>");
    print(dirname(__FILE__));
}

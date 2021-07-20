<?

namespace app\lib;

use PDO;

class Router
{

    public function __construct(array $model)
    {
        for($i = 0; $i < count($model); $i++){
            include $model[$i]["url"];
        }
    }

}
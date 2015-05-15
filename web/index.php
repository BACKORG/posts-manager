<?php
// Return a BSON_LONG as an instance of MongoInt64
ini_set('mongo.long_as_object', 1);

// development environment
$ra = getenv('REMOTE_ADDR');
if($ra == '127.0.0.1'){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}


require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();

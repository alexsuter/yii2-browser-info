<?php
error_reporting(- 1);

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);

$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once (__DIR__ . '/../vendor/autoload.php');
require_once (__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$application = new yii\console\Application([
    'id' => 'test-console-application',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'pahanini\log\ConsoleTarget',
                ]
            ],
        ],
    ],
]);

?>
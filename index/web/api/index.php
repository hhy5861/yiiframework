<?php
error_reporting(E_ALL ^E_NOTICE);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV')   or define('YII_ENV', 'dev');

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/vendor/autoload.php');
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/vendor/yiisoft/yii2/Yii.php');
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/common/config/public/bootstrap.php');
require(dirname(dirname(dirname(__FILE__)))          . '/config/api/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(require(dirname(dirname(dirname(dirname(__FILE__)))) . '/common/config/public/main.php'),
                                         require(dirname(dirname(dirname(dirname(__FILE__)))) . '/common/config/api/main.php'),
                                         require(dirname(dirname(dirname(__FILE__)))          . '/config/api/main.php')
										);

$application = new yii\web\Application($config);
$application->run();

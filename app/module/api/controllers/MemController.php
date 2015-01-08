<?php
/**
 * @author mike
 * WeiapiController 控制器调试
 */
namespace api\controllers;

use Yii;
use app\library\test\Test;
use yii\mongodb\Query;
use app\components\service\Cache;

class MemController extends \yii\web\Controller
{
	private $key = 'test';

	public function init()
	{
		parent::init();
	}

	public function actionIndex()
	{

		$arr['key']    = $this->key;
		$data = Cache::instance($arr)->get();
		if(!$data)
		{
			$data = [1,2,3,4,5,6];
			$arr['expire'] = '120';
			Cache::instance($arr)->set($data);
			echo '设置缓存并输出<br/>';
		}
		else
		{
			echo '缓存数据输出<br/>';
		}

		echo '<pre>';
		print_r($data);
	}

	public function actionDel()
	{

		$arr['key']    = $this->key;
		$data = Cache::instance($arr)->del();

		echo '<pre>';
		print_r($data);
	}

	public function actionMongodb()
	{
		//$collection = Yii::$app->mongodb->getCollection('t_test');
		//$collection->insert(['name' => 'John Smith', 'status' => 1]);

		$query = new Query;
		$row   = $query->from('t_test')->one();
		var_dump($row['_id']);
		//var_dump((string) $row['_id']);
	}
}

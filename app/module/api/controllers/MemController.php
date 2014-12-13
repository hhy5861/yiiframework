<?php
/**
 * @author mike
 * WeiapiController 控制器调试
 */
namespace api\controllers;

use app\components\cache\memcache\Cache;

class MemController extends \yii\web\Controller
{
	private $key = 'test';

	public function actionDemo()
	{
		$arr['key']    = $this->key;
		$arr['expire'] = '120';

		$data = Cache::instance($arr)->get();
		if(!$data)
		{
			$data = [1,2,3,4,5,6];
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
}

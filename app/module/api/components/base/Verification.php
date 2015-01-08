<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14/12/11
 * Time: 下午4:27
 */

namespace api\components\base;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\web\UnauthorizedHttpException;

class Verification extends CompositeAuth
{
	public  $param;

	/**
	 * @param ActionEvent $event
	 * @return boolean
	 * @throws MethodNotAllowedHttpException when the request method is not allowed.
	 */
	public function beforeAction($event)
	{
		if($this->param['token'] !== $this->createSha1())
		{
			throw new UnauthorizedHttpException('token validation fails');
		}
		return true;
	}

	/**
	 * 生成sha1
	 * @return string
	 */
	private function createSha1()
	{
		unset($this->param['token']);
		$sortArr    = array_merge($this->param, ['token' => Yii::$app->params['TOKEN']]);
		sort($sortArr, SORT_STRING);
		$tmpStr     = implode($sortArr);
		$tmpStr     = sha1($tmpStr);

		return $tmpStr;
	}
} 
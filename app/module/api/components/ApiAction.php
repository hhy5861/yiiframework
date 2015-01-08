<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace api\components;

use Yii;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

/**
 * Action is the base class for action classes that implement RESTful API.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ApiAction extends \yii\base\Action
{

    /**
     * @var callable a PHP callable that will be called when running an action to determine
     * if the current user has the permission to execute the action. If not set, the access
     * check will not be performed. The signature of the callable should be as follows,
     *
     * ```php
     * function ($action, $model = null) {
     *     // $model is the requested model instance.
     *     // If null, it means no specific model (e.g. IndexAction)
     * }
     * ```
     */
    public $checkAccess;

	/**
	 * @param $status
	 * @param string $message
	 * @param array $data
	 * @return array
	 */
	protected function restData($status,$message = '', array $data)
	{
		if(empty($data))
		{
			$status  = 0;
			$message = 'This request does not have data recorded';
			$data    = [];
		}

		$arr = ['status'  => $status,
		        'message' => $message,
			    'data'    => $data
		       ];

		return $arr;
	}
}

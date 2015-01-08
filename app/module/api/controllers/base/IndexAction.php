<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace api\controllers\base;

use Yii;
use app\library\test\Test;
use api\components\ApiAction;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAction extends ApiAction
{

	/**
	 *
	 */
    public function run()
    {
	    $param = Yii::$app->controller->getData;

	    if($param['v'] == 1.0)
	    $model = (new Test())->getAll($param);

		return $this->restData(0,'success',$model);
    }
}

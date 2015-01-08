<?php
/**
 * @author mike
 * WeiapiController 控制器调试
 */
namespace api\controllers;

use Yii;
use api\components\ApiController;

class SiteController extends ApiController
{
	public function init()
	{
		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
				'index' => [
							'class'       => 'api\controllers\base\IndexAction',
						   ],
			   ];
	}

	/**
	 * @inheritdoc
	 */
	protected function verbs()
	{
		return [
				'index' => ['POST'],
			   ];
	}
}

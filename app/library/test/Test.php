<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14/12/14
 * Time: 下午2:03
 */

namespace app\library\test;

use app\models\db\User;

class Test
{
	public function getAll($param)
	{
		$data = User::findOne($param['id'])->attributes;
		return $data;
	}
} 
<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14-8-26
 * Time: 15:01
 */

namespace app\components\cache;

use Yii;
use yii\base\Exception;

class Cache implements ICache
{
    private static $time;

    private static $key;

    private static $param = [];

    private static $_instance;

    private static $defaultKey;

    public static $setCacheTime;

    private function __construct(){}

    public static function instance(array $param)
    {
        self::$defaultKey   = 'j*slkd92#';
        self::$param        = $param;
        self::$time         = time();
        self::$setCacheTime = $param['expire'] ? $param['expire'] : Yii::$app->params['CACHE_TIME'];

        !self::$_instance && self::$_instance = new self();
        return self::$_instance;
    }

    private function __clone()
    {
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }

    /**
     * 设置缓存Key
     * @return string
     */
    private static function _setKey()
    {
	    if(!self::$param['key'])
	    {
			return new Exception('The cache key is not set');
	    }

        self::$key = md5(self::$defaultKey . self::$param ['key']);
        return self::$key;
    }

    /**
     * 设置缓存值
     * @return bool
     */
    public function set($value)
    {
        if(Yii::$app->params['CACHE_SWITCH'])
        {
            $data = Yii::$app->memCache->set(self::_setKey(),
                                             $value,
                                             self::$setCacheTime
                                            );

            return $data;
        }

        return false;
    }

    /**
     * 获取缓存值
     * @return bool
     */
    public function get()
    {
        if(Yii::$app->params['CACHE_SWITCH'])
        {
            $data = Yii::$app->memCache->get(self::_setKey());
            if($data) return $data;
        }

        return false;
    }

    /**
     * 删除缓存元素
     */
    public function del()
    {
	    return Yii::$app->memCache->delete(self::_setKey());
    }
} 
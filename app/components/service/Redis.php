<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14-8-26
 * Time: 15:01
 */

namespace app\components\service;

use yii;
class Redis implements IService
{
    private static $key;

    private static $_instance;

    private function __construct(){}

    public static function getInstance($key)
    {
        $defaultKey = '20650294a3a2a6a4bf7e785f1ec39dcc';
        self::$key  = md5($defaultKey.$key);
        !self::$_instance && self::$_instance = new self();
        return self::$_instance;
    }

    private function __clone()
    {
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }

    /**
     * 从左边插入一个元素
     * @param $value
     */
    public function lPush($value)
    {
        yii::$app->redis->executeCommand('LPUSH',[self::$key,serialize($value)]);
    }

    /**
     * 从右边插入一个元素
     * @param $value
     */
    public function rPush($value)
    {
        yii::$app->redis->executeCommand('RPUSH',[self::$key,serialize($value)]);
    }

    /**
     * 获取列表起
     * @param array $param
     * @internal param $offset
     * @internal param $size
     * @return mixed
     */
    public function lRange(array $param)
    {
        return yii::$app->redis->executeCommand('LRANGE',[self::$key,
                                                          $param['offset'],
                                                          $param['size']
                                                         ]);
    }

    public function listAll($offset=0, $size=0)
    {
        $listLen = '';
        !$size && $listLen = Yii::$app->redis->executeCommand('LLEN',[self::$key]);

        $arr['offset'] = $offset ? $offset : 0;
        $arr['size']   = $size ? $size : $listLen;
        return self::lRange($arr);
    }

    /**
     * 删除某个元素
     * @param $limit
     * @param $value
     */
    public function lRem($limit,$value)
    {
        return yii::$app->redis->executeCommand('LREM',[self::$key, $limit, serialize($value)]);
    }

    /**
     * 删除某个列表
     * @return mixed
     */
    public function del()
    {
        return yii::$app->redis->executeCommand('DEL',[self::$key]);
    }

    /**
     * 设置hash里面一个字段的值
     * @param array $param
     * @param $seconds
     */
    public function hSet($field,array $param,$seconds=0)
    {
        $status = yii::$app->redis->executeCommand('HSET',[self::$key,
                                                           $field,
                                                           serialize($param)
                                                          ]
                                                   );
        if($seconds && $status)
        {
            self::expiree(self::$key,$seconds);
        }

        return $status;
    }

    /**
     * 读取哈希域的的值
     * @param $field
     * @return mixed
     */
    public function hGet($field)
    {
        $data = yii::$app->redis->executeCommand('HGET',[self::$key,
                                                         $field,
                                                        ]
                                                  );

        return unserialize($data);
    }

    /**
     * 设置有较时间
     * @param $seconds
     * @return mixed
     */
    public function expiree($seconds)
    {
        return yii::$app->redis->executeCommand('EXPIRE', [self::$key,$seconds]);
    }

    /**
     * 执行原子加1操作
     * @return mixed
     */
    public function incr()
    {
        return yii::$app->redis->executeCommand('INCR', [self::$key]);
    }

    /**
     * 获取key的有效时间（ 单位：秒）
     * @return mixed
     */
    public function ttl()
    {
        return yii::$app->redis->executeCommand('TTL', [self::$key]);
    }
}
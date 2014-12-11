<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14-7-22
 * Time: 9:52
 */

namespace app\library\funs;
header('Content-Type: text/html; charset=UTF-8');
use yii;
use yii\helpers\Json;

class CurlAction
{
    private static $curl;

    private static $instance;

    /**
     * 防止创建对象
     */
    private function __construct(){}

    //单例方法
    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance=new self();
        }
        return self::$instance;
    }

    //阻止用户复制对象实例
    private function __clone()
    {
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }

    /**
     * POST 提交
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendPost($url,$param = [])
    {
        $message = Yii::$app->curl->setOption(CURLOPT_CONNECTTIMEOUT,5)->post($url,$param);
        return Json::decode($message);
    }

    /**
     * GET提交
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendGet($url,$param = [])
    {
        $message = Yii::$app->curl->get($url,$param);
        return Json::decode($message);
    }

    /**
     * HTTP格式删除
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendDelete($url,$param = [])
    {
        $message = Yii::$app->curl->delete($url,$param);
        return Json::decode($message);
    }

    /**
     * GET下载图片提交
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendImageGet($url,$param = [])
    {
        $message = Yii::$app->curl->setOption(CURLOPT_HEADER, 1)->get($url,$param);

        list($header, $img)  =  explode("\r\n\r\n", $message, 2);

        preg_match('/filename="(.*)"/', $header, $name);
        $fileName            = '/tmp/'.$name[1];
        $size                = file_put_contents($fileName, $img);
        return [$fileName,$size];
    }

    /**
     * 设置两段URL
     * @param $url
     * @param array $param
     * @return bool|string
     */
    public function setUrl($url,$param = [])
    {
        if(is_array($param))
        {
            return $url.http_build_query($param);
        }
        return false;
    }
}
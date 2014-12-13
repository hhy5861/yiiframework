<?php
/**
 * @author mike
 * WeiapiController 控制器调试
 */
namespace api\controllers;

use yii;
use yii\db\Query as DbQuery;
use yii\mongodb\Query;
use app\models\db\Bind;
use app\components\service\Cache;
use app\components\service\Redis;
use api\components\ApiController;

class SiteController extends ApiController
{
    public function init()
    {
        parent::init();
    }

    //redis调用
    public function actionIndex()
    {
        echo 'Yii2.0 Redis实用实例：<br>';
        echo '<pre>';
        $field          = 'fieldsd';   //字段
        $param['cid']    = 4;
        $param['app_id'] = 3;
        Redis::getInstance('test')->hSet($field,$param);

        $data = Redis::getInstance('test')->hGet($field);
        print_r($data);
    }

    //memcache调用
    public function actionMemCache()
    {
        echo 'Yii2.0 memcache实用实例：<br>';
        echo '<pre>';
        $param['cacheTime'] = 4; //缓存时间
        $arr['cid']         = 4;
        $arr['app_id']      = 3;
        yii::$app->memCache->set($param,$arr);

        $data = yii::$app->memCache->get($param);
        print_r($data);
    }

    public function actionDbar()
    {
        echo 'Yii2.0 ActiveRecord(简称：AR) MySql查询实例：<br>';
        echo '<pre>';
        $customers = Bind::find()
                     ->where(['valid' => 0])
                     ->one()
                     ->attributes;
        print_r($customers);
    }

    public function actionDbDao()
    {
        echo 'Yii2.0 DAO MySql查询实例：<br>';
        echo '<pre>';
        $customers = (new DbQuery)
                     ->select('corp_id')
                     ->from('{{%bind}} a')
                     ->leftJoin('{{%app_center}} b','a.cid = b.id')
                     ->where('a.valid = 0')
                     ->one();

        print_r($customers);
    }

    public function actionMongo()
    {
        echo 'Yii2.0 MONGODB 实例：<br>';
        echo '<pre>';
        $collection = Yii::$app->mongodb->getCollection('customer');
        //$collection->insert(['name' => 'Mike', 'status' => 0]);

        $query = new Query;

        $query->select(['name', 'status'])->from('customer');
        $rows = $query->all();
        echo '一共有：'.count($rows).'条<br>';
        echo '<br>';
        foreach($rows as $v)
        {
            print_r($v['name']);
            echo ' => ';
            print_r($v['status']);
            echo '<br>';
        }
    }
}

<?php
/**
 * @author mike
 * WeiapiController 控制器基类
 */
namespace api\components;

use yii;
use yii\web\Controller;
use app\library\funs\Encrypt;

abstract class ApiController extends Controller
{
    public $getData;

    public function init()
    {
        parent::init();

        $tParam = Yii::$app->getRequest()->getQueryParam('t');
        $tParam && $this->getData = Encrypt::getInstance()->decrypt($tParam);

        if(!isset($this->getData['pid']))
            $this->getData['pid'] = Yii::$app->session->get('pid');

        if(!isset($this->getData['cid']))
            $this->getData['cid'] = Yii::$app->session->get('cid');
    }

    /**
     * 创建加密后的URl
     * @param $route
     * @param array $encryptUrl
     * @return string
     */
    public function createUrl($route, array $encryptUrl =[])
    {
        $encryptUrl = Encrypt::getInstance()->encrypt($encryptUrl);
        return Yii::$app->urlManager->createUrl([$route, 't' => $encryptUrl]);
    }
}
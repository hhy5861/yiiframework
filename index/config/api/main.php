<?php
$params = array_merge(
                      require(dirname(dirname(dirname(dirname(__FILE__)))) . '/common/config/public/params.php'),
                      require(dirname(dirname(dirname(dirname(__FILE__)))) . '/common/config/api/params.php'),
                      require(dirname(__FILE__) . '/params.php')
                     );

return [
        'id'                  => 'api',
        'basePath'            => dirname(dirname(dirname(dirname(__FILE__)))) . '/app/',
        'defaultRoute'        => 'api/site/index',
        'bootstrap'           => ['log'],

        'modules'   => [
                        'api' => [
                                  'class' => 'app\module\api\ApiModule',
                                 ],
                       ],

        'components' => [
                         'urlManager'   => [
                                            'enablePrettyUrl'     => true,
                                            'showScriptName'      => false,
                                            'rules' => [
                                                        '<controller:^(?!api|resource|Resource|feedback|Feedback)\w+>/<action:\w+>' => 'api/<controller>/<action>',
                                                        '<url:^(?!api|resource|Resource|feedback|Feedback).+>' => 'api/<url>',

                                                       ],
                                           ],

                        'log'           => [
                                            'traceLevel' => YII_DEBUG ? 3 : 0,
                                            'targets'    => [[
                                                              'class' => 'yii\log\FileTarget',
                                                              'levels' => ['error', 'warning'],
                                                             ],

                                                            ],
                                           ],

                        'request'      => [
                                           'enableCookieValidation' => true,
                                           'enableCsrfValidation'   => false,
                                           'cookieValidationKey'    => '8a5da52ed126447d359e70c05721a8aa',
                                          ],

                        /*'errorHandler' => [
                          'errorAction'  => 'site/index',
                        ],*/

                     ],

        'params' => $params,
];


<?php
return [
        'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

        'components' => [
                         'curl'      => [
                                         'class'   => 'yii\curl\Curl',
                                        ],

                         'redis'     => [
                                         'class'       => 'yii\redis\Connection',
                                         'hostname'    => '127.0.0.1',
                                         'port'        => 6379,
                                         'password'    => 'b08d03064a516dcfbe6bc56f5b749359',
                                         'database'    => 1,
                                         'dataTimeout' => 30,
                                        ],

                        'memCache'   => [
                                         'class'        => 'yii\caching\MemCache',
                                         'useMemcached' => true,
                                         'servers'      => [
                                                            [
                                                             'host'         => '127.0.0.1',
                                                             'port'         => 11211,
                                                             'weight'       => 60,
                                                            ],
                                                           ],
                                        ],

                       'mongodb'     => [
                                         'class'        => 'yii\mongodb\Connection',
                                         'dsn'          => 'mongodb://127.0.0.1:27017/mydatabase',
                                        ],

                    'db'        => [
                                     'class'       => 'yii\db\Connection',
                                     'dsn'         => 'mysql:host=121.41.37.43;dbname=d_wework',
                                     'username'    => 'wework_admin',
                                     'password'    => '7y8E09gRYp*NY76Gug',
                                     'charset'     => 'utf8',
                                     'tablePrefix' => 't_wework_',
                                    ],
                        ],
];

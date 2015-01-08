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

                         'memCache'  => [
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

                         'mongodb'   => [
                                         'class'        => 'yii\mongodb\Connection',
                                         'dsn'          => 'mongodb://mike:tlslpc@127.0.0.1:27017/admin',
                                        ],

                         'db'        => [
                                         'class'        => 'yii\db\Connection',
                                         'dsn'          => 'mysql:host=127.0.0.1;dbname=test',
                                         'username'     => 'root',
                                         'password'     => '',
                                         'charset'      => 'utf8',
                                         'tablePrefix'  => 't_mike_',
                                        ],
                         ],
];

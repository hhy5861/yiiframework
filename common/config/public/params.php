<?php
$time = time();

return [
        'TIME'                 => $time,

        'ENV'                  => 'TEST', //指定环境

        'CACHE_SWITCH'         => true,  //缓存开关
        'CACHE_TIME'           => 7200,   //缓存过期时间
        'CACHE_PROXY_TIME'     => 120,    //缓存可见性时间
        'CGI_STINT_SWITCH'     => false, // CGI访问限制开关
        'MESSAGE_CACHE_TIME'   => 7200,

        'OSSDEBUGMODE'         => false,   //OSS debug开关
        'OSSBUCKET'            => 'wework-test',  //
        'OSSHOSTNAME'          => 'oss-cn-hangzhou.aliyuncs.com',
        'OSSDOMAIN'            => 'http://wework-test.oss.aliyuncs.com',

        'STATIC_VERSION'       => date('ymdHi', $time),

        'COMPANY_DOMAIN'       => 'http://local.company.bangong24.com',
        'STATIC_DOMAIN'        => 'http://local.stc.bangong24.com',
        'WEISITE_DOMAIN'       => 'http://local.weisite.bangong24.com',
        'API_DOMAIN'           => 'http://local.api.bangong24.com',
       ];
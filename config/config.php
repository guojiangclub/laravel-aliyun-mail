<?php

return [
    'aliyunmail' => [
        'access_key' => env('ALIYUN_MAIL_ACCESS_KEY'),
        'access_secret' => env('ALIYUN_MAIL_ACCESS_SECRET'),
        'region' => env('ALIYUN_MAIL_REGION', 'cn-hangzhou'),
        'account_name' => env('ALIYUN_MAIL_ACCOUNT_NAME'),
        'account_alias' => env('ALIYUN_MAIL_ACCOUNT_ALIAS')
    ]
];
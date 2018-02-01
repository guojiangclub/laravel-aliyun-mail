<?php

/*
 * This file is part of ibrand/laravel-aliyun-mail.
 *
 * (c) iBrand <https://www.ibrand.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace iBrand\AliyunMail;

use Illuminate\Mail\TransportManager;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Service Provider register.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'services'
        );

        $this->app->resolving('swift.transport', function (TransportManager $transportManager) {
            $transportManager->extend('aliyunmail', function () {
                $region = config('services.aliyunmail.region');
                $accessKey = config('services.aliyunmail.access_key');
                $accessSecret = config('services.aliyunmail.access_secret');
                $accountName = config('services.aliyunmail.account_name');
                $accountAlias = config('services.aliyunmail.account_alias');

                return new DirectMailTransport($region, $accessKey, $accessSecret, $accountName, $accountAlias);
            });
        });
    }
}

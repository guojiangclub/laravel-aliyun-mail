<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 11:16
 */

namespace iBrand\AliyunMail;


use Illuminate\Mail\TransportManager;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'services'
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
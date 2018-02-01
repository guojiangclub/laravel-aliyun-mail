# Laravel Aliyun Mail

Aliyun Single Send Mail Services for Laravel.

## Installation

```sh
composer require ibrand/laravel-aliyun-mail -vvv
```

If your Laravel version below 5.5, you need add  the follow line to the section `providers` of `config/app.php`:

```sh
iBrand\AliyunMail\ServiceProvider::class,
```

## Usage

### Set aliyun for mail driver.

Set `MAIL_DRIVER=aliyunmail` in .env file.

### Set aliyun account 

1. Setting up from the `config/services.php` file.

```php
    'aliyunmail' => [
            'access_key' => env('ALIYUN_MAIL_ACCESS_KEY','your aliyun access key'),
            'access_secret' => env('ALIYUN_MAIL_ACCESS_SECRET','your aliyun access secret'),
            'region' => env('ALIYUN_MAIL_REGION', 'cn-hangzhou','your aliyun mail account region'),
            'account_name' => env('ALIYUN_MAIL_ACCOUNT_NAME','your aliyun mail account name'),
            'account_alias' => env('ALIYUN_MAIL_ACCOUNT_ALIAS','your aliyun mail account alias')
        ]
```

2. Setting up from `.env` file.

```
ALIYUN_MAIL_ACCESS_KEY=
ALIYUN_MAIL_ACCESS_SECRET=
ALIYUN_MAIL_REGION=
ALIYUN_MAIL_ACCOUNT_NAME=
ALIYUN_MAIL_ACCOUNT_ALIAS=
```

> https://laravel.com/docs/5.5/mail
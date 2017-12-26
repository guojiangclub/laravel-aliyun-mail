<?php

namespace iBrand\AliyunMail;


use ClientException;
use Illuminate\Mail\Transport\Transport;
use ServerException;
use Swift_Mime_SimpleMessage;
use Dm\Request\V20151123 as Dm;

require_once __DIR__ . "/../libs/aliyun-php-sdk-core/Config.php";


/**
 * Class DirectMailTransport
 * @package iBrand\AliyunMail
 * aliyun mail document: https://help.aliyun.com/document_detail/29460.html?spm=5176.doc29435.6.583.WtXus4
 */
class DirectMailTransport extends Transport
{

    protected $region;
    protected $accessKey;
    protected $accessSecret;
    protected $accountName;
    protected $accountAlias;

    public function __construct($region, $accessKey, $accessSecret, $accountName, $accountAlias)
    {
        $this->region = $region;
        $this->accessKey = $accessKey;
        $this->accessSecret = $accessSecret;
        $this->accountName = $accountName;
        $this->accountAlias = $accountAlias;
    }

    /**
     * Send the given Message.
     *
     * Recipient/sender data will be retrieved from the Message API.
     * The return value is the number of recipients who were accepted for delivery.
     *
     * @param Swift_Mime_SimpleMessage $message
     * @param string[] $failedRecipients An array of failures by-reference
     *
     * @return int
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $iClientProfile = \DefaultProfile::getProfile($this->region, $this->accessKey, $this->accessSecret);
        $client = new \DefaultAcsClient($iClientProfile);

        $request = new Dm\SingleSendMailRequest();
        $request->setAccountName($this->accountName);    //控制台创建的发信地址
        $request->setFromAlias($this->accountAlias);
        $request->setAddressType(1);
        $request->setReplyToAddress('true');
        $request->setToAddress($this->getToAddress($message));
        $request->setSubject($message->getSubject());
        $request->setHtmlBody($message->getBody());

        try {
            return $client->getAcsResponse($request);
        } catch (ClientException  $e) {
            \Log::info($e->getErrorCode() . ':' . $e->getErrorMessage());
        } catch (ServerException  $e) {
            \Log::info($e->getErrorCode() . ':' . $e->getErrorMessage());
        }

        return false;
    }

    /**
     * @param Swift_Mime_SimpleMessage $message
     * @return string
     * 目标地址，多个 email 地址可以用逗号分隔，最多100个地址, document: https://help.aliyun.com/document_detail/29444.html?spm=5176.doc29435.2.3.XKDMXA
     */
    protected function getToAddress(\Swift_Mime_SimpleMessage $message)
    {
        return join(',', array_keys($message->getTo()));
    }
}
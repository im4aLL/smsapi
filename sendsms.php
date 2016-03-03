<?php

use SMSApi\Client;
use SMSApi\Api\SmsFactory;
use SMSApi\Exception\SmsapiException;

require_once 'vendor/autoload.php';

$client = new Client('my-username');
$client->setPasswordHash(md5('my-plain-password'));

$smsapi = new SmsFactory;
$smsapi->setClient($client);

try {
    $actionSend = $smsapi->actionSend();

    $actionSend->setTo('8801619004234');
    $actionSend->setText('Hello World!!');
    $actionSend->setSender('Mercedes');

    $response = $actionSend->execute();

    foreach ($response->getList() as $status) {
        echo $status->getNumber() . ' ' . $status->getPoints() . ' ' . $status->getStatus();
    }
} catch (SmsapiException $exception) {
    echo 'ERROR: ' . $exception->getMessage();
}

// it does output - ERROR: Authorization failed

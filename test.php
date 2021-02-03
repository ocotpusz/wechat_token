<?php

use Octopusz\WxToken\GetWxToken;
require ('vendor/autoload.php');

$appId = "xxxxxxxxxx";
$secret = "xxxxxxxxxxxxxxxxx";
$url = "xxxxxxxxxxxxxxxxxxxxxxxxx";
$timestamp = time();
$nonceStr = GetWxToken::getAccessToken($appId,$secret);
$access = $nonceStr->access_token;
$getTicket = GetWxToken::getTicket($access);
$ticket = $getTicket->ticket;
$res =  GetWxToken::getSignature($nonceStr,$url,$ticket, $timestamp);
var_dump($res);


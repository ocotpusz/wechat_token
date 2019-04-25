<?php

namespace Octopusz\WxToken;

class GetWxToken
{

    public static function getAccessToken($appId, $secret)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appId . "&secret=" . $secret);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    public static function getTicket($token)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $token . "&type=jsapi");
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    public static function getSignature($noncestr,$url,$ticket)
    {
        $tmpArr = array(
            'noncestr' => $noncestr,
            'timestamp' => time(),
            'jsapi_ticket' => $ticket,
            'url' => $url
        );
        ksort($tmpArr, SORT_STRING);
        $string1 = http_build_query($tmpArr);
        $string1 = urldecode($string1);
        $signature = sha1($string1);
        return $signature;
    }


}


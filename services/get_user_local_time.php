<?php

function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_user_local_time()
{


    $user_ip = getIPAddress();

    if (!filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        //return "INVALID USER IP " . $user_ip;
        $user_ip = "213.35.190.234";
    }

    $url = "http://ipinfo.io/" . $user_ip;
    $ip_info = json_decode(file_get_contents($url));
    echo json_encode([$ip_info, $_SERVER["HTTP_CF_CONNECTING_IP"], $_SERVER['REMOTE_ADDR']
    , $_SERVER['HTTP_X_FORWARDED_FOR'], $_SERVER['HTTP_CLIENT_IP']
]);

    $timezone = "dssadasf"; //$ip_info->timezone;
    $date = new DateTime(date('m/d/Y h:i:s a', time()));
    $date->setTimezone(new DateTimeZone($timezone));

    return $date;
}

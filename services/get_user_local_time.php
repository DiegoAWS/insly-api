<?php

function get_user_local_time()
{


    $user_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);

    if (!filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        //return "INVALID USER IP " . $user_ip;
        $user_ip = "213.35.190.234";
    }

    $url = "http://ipinfo.io/" . $user_ip;
    $ip_info = json_decode(file_get_contents($url));
    echo json_encode([$ip_info, $_SERVER["HTTP_CF_CONNECTING_IP"], $_SERVER['REMOTE_ADDR']]);

    $timezone = "dssadasf"; //$ip_info->timezone;
    $date = new DateTime(date('m/d/Y h:i:s a', time()));
    $date->setTimezone(new DateTimeZone($timezone));

    return $date;
}

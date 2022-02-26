<?php

function get_user_local_time()
{


    $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);

    if(! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return "INVALID_IP: " . $ip;


    }

    $ch = file_get_contents('https://ipapi.co/' . $ip . '/json/');
    $ipParts = json_decode($ch, true);

    if($ipParts["error"]) {
        return  $ch;
    }

    
    $timezone = $ipParts['timezone'];
    $date = new DateTime(date('m/d/Y h:i:s a', time() ));
    $date->setTimezone(new DateTimeZone($timezone));

    return $date->format(DATE_ATOM);
}

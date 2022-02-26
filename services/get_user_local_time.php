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
        return "INVALID USER IP " . $user_ip;
        // $user_ip = "213.35.190.234";
    }

    $url = "http://ipinfo.io/" . $user_ip;
    $ip_info = json_decode(file_get_contents($url));
    $timezone = $ip_info->timezone;

    $city = $ip_info->city;
    $region = $ip_info->region;
    $country = $ip_info->country;

    if (!isset($ip_info->timezone)) {
        return "INVALID USER IP " . $user_ip;
    }

    $location = '';

    if (isset($city)) {
        $location .= $city . " ";
    }
    if (isset($region)) {
        $location .= $region . " ";
    }
    if (isset($country)) {
        $location .= $country;
    }


    $date = new DateTime(date('m/d/Y h:i:s a', time()));
    $date->setTimezone(new DateTimeZone($timezone));

    return [
        'date' => $date,
        'location' => $location
    ];
}

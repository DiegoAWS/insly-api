<?php

function insurancePost(){
    header('Content-Type: application/json');
    $json = json_decode(file_get_contents('php://input'), true);

    $data = data_validators($json);

    if (!isset($data)) {
        return;
    }

    $car_price = $data['car_price'];
    $tax_percentage = $data['tax_percentage'];
    $number_of_policies = $data['number_of_policies'];

    $week_day=$data['week_day'];
    $hour_of_day=$data['hour_of_day'];

  

    $user_ip_info ="";// get_user_local_time();

    $datetime_from_ip = date_create();
    $user_time_coincide = false;

    // If user ip is invalid $user_ip_info will be an error message (string)
    if (!is_string($user_ip_info)) {

        $datetime_from_ip = $user_ip_info['date'];
        $week_day_from_ip = $datetime_from_ip->format('w');
        $hour_of_day_from_ip = $datetime_from_ip->format('H');

        $user_time_coincide = ($week_day == $week_day_from_ip && $hour_of_day == $hour_of_day_from_ip);

        $datetime_from_ip = $datetime_from_ip->format(DATE_ATOM);

        $user_ip_info = $user_ip_info['location'];
    }


    $base_price_policy = get_base_price_policy($week_day, $hour_of_day);

    $insurance_data = calculate_insurance($car_price, $tax_percentage, $number_of_policies, $base_price_policy);

    $data_keys = ['value', 'base_premium', 'commission', 'tax', 'total_cost'];
    $data_labels = [
        'Value',
        'Base Premium(' . $base_price_policy . '%)',
        'Commission(17%)',
        'Tax(' . $tax_percentage . '%)',
        'Total Cost'
    ];



    echo json_encode([
        'user_time_coincide' => $user_time_coincide,
        'user_time' => $datetime_from_ip,
        'user_ip_info' => $user_ip_info,
        'insurance_data' => $insurance_data,
        'data_keys' => $data_keys,
        'base_price_policy' => $base_price_policy,
        'data_labels' => $data_labels
    ]);
}

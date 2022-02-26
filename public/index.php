<?php


try {

    require_once __DIR__ . '/../helpers/router.php';
    require_once __DIR__ . '/../helpers/cors.php';
    require_once __DIR__ . '/../services/get_user_local_time.php';
    require_once __DIR__ . '/../services/insurance_services.php';
    require_once __DIR__ . '/../validators/data_validators.php';

    cors();

    // With named parameters
    router('GET', '^/$', function () {
        echo "Server ONLINE";
    });

    // POST request to /api
    router('POST', '^/api$', function () {
        header('Content-Type: application/json');
        $json = json_decode(file_get_contents('php://input'), true);

        $data = data_validators($json);

        if (!isset($data)) {
            return;
        }

        $car_price = $data['car_price'];
        $tax_percentage = $data['tax_percentage'];
        $number_of_policies = $data['number_of_policies'];
        $local_time_formated = $data['local_time_formated'];

        $week_day = date('w', $local_time_formated->getTimestamp());
        $hour_of_day = date('H', $local_time_formated->getTimestamp());

        $user_ip_info = get_user_local_time();

        $datetime_from_ip='';
        $user_time_coincide = false;

        // If user ip is invalid $user_ip_info will be an error message (string)
        if (! is_string($user_ip_info)) {

            $datetime_from_ip = $user_ip_info['date'];
            $week_day_from_ip = date('w', $datetime_from_ip->getTimestamp());
            $hour_of_day_from_ip = date('H', $datetime_from_ip->getTimestamp());

            $user_time_coincide = ($week_day == $week_day_from_ip && $hour_of_day == $hour_of_day_from_ip);

            $datetime_from_ip=$datetime_from_ip->format(DATE_ATOM);

            $user_ip_info = $user_ip_info['location'];
        } 





        echo json_encode([
            'user_time_coincide' => $user_time_coincide,
            'user_time' => $datetime_from_ip,
            'user_ip_info' => $user_ip_info,
            'user_ip_time' => $local_time_formated->format(DATE_ATOM),
            'insurance_data' => calculate_insurance($car_price, $tax_percentage, $number_of_policies, $week_day, $hour_of_day)
        ]);
    });

    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
} catch (\Throwable $th) {
    echo json_encode(['error' => $th->getMessage()]);
}

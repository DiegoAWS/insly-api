<?php


try {

    require_once __DIR__ . '/../helpers/router.php';
    require_once __DIR__ . '/../helpers/cors.php';
    require_once __DIR__ . '/../helpers/get_user_local_time.php';
    require_once __DIR__ . '/../services/insuranceServices.php';



    cors();

    // With named parameters
    router('GET', '^/$', function () {
        echo "Server ONLINE";
    });

    // POST request to /api
    router('POST', '^/api$', function () {
        header('Content-Type: application/json');
        $json = json_decode(file_get_contents('php://input'), true);
        $car_price = $json['car_price'];
        $tax_percentage = $json['tax_percentage'];
        $number_of_policies = $json['number_of_policies'];
        $local_time = $json['local_time'];

        $local_time_formated = date_create($local_time);
        // Check if any of the parameters are empty
        if (is_null($car_price) || is_null($tax_percentage) || is_null($number_of_policies) || is_null($local_time)) {
            echo json_encode(['error' => 'Missing parameters']);
            return;
        }


        $week_day = date('w', $local_time_formated->getTimestamp());
        $hour_of_day = date('H', $local_time_formated->getTimestamp());

        echo json_encode([
            'user_ip_hour' => get_user_local_time(),
            'insurance_data' => calculate_insurance($car_price, $tax_percentage, $number_of_policies, $week_day, $hour_of_day)
        ]);
    });

    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
} catch (\Throwable $th) {
    echo json_encode(['error' => $th->getMessage()]);
}

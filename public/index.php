<?php

// Router File

try {

    require_once __DIR__ . '/../controllers/insurance_controller.php';
    require_once __DIR__ . '/../helpers/router.php';
    require_once __DIR__ . '/../helpers/cors.php';
    require_once __DIR__ . '/../services/get_user_local_time.php';
    require_once __DIR__ . '/../services/insurance_services.php';
    require_once __DIR__ . '/../validators/data_validators.php';

    cors();

    // With named parameters
    router('GET', '^/$', function () {
        echo 'Server ONLINE';
    });

    // POST request to /api
    router('POST', '^/api$',  insurancePost());

    // 404 on all other routes
    header('HTTP/1.0 404 Not Found');
    echo '404 Not Found';
} catch (\Throwable $th) {
    echo json_encode(['error' => $th->getMessage()]);
}

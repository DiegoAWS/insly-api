<?php

require_once __DIR__ . '/../helpers/router.php';

// // With named parameters
// router('GET', '^/users/(?<id>\d+)$', function($params) {
//     echo "You selected User-ID: ";
//     var_dump($params);
// });

// POST request to /users
router('POST', '^/users$', function() {
    header('Content-Type: application/json');
    $json = json_decode(file_get_contents('php://input'), true);
    var_dump($json["test1"]);
    echo json_encode($json);
});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
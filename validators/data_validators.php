<?php


function data_validators($json)
{

    $validated = [];

    // Check if any of the parameters are empty or is not a number
    $validators = [
        [
            'param' => 'car_price',
            'options' => ['options' => ['min_range' => 100, 'max_range' => 100000]],
        ],
        [
            'param' => 'tax_percentage',
            'options' => ['options' => ['min_range' => 0, 'max_range' => 100]],
        ],
        [
            'param' => 'number_of_policies',
            'options' => ['options' => ['min_range' => 1, 'max_range' => 12]],
        ],
        [
            'param' => 'hour_of_day',
            'options' => ['options' => ['min_range' => 0, 'max_range' => 23]],
        ],
        [
            'param' => 'week_day',
            'options' => ['options' => ['min_range' => 0, 'max_range' => 6]],
        ]


    ];

    for ($i = 0; $i < count($validators); $i++) {
        $param_name = $validators[$i]['param'];
        $param_value = $json[$param_name];
        $param_options = $validators[$i]['options'];

        $test_value = filter_var($param_value, FILTER_VALIDATE_INT, $param_options);

        if (!isset($param_value) || $test_value === false) {

            echo json_encode(['error' => 'Invalid field [' . $param_name . '] with value ' . $param_value]);
            return;
        } else {
            $validated[$param_name] = $test_value;
        }
    }

    return $validated;
}

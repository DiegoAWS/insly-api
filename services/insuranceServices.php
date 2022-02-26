<?php



function get_base_price_policy($week_day, $hour_of_day)
{
    return ($week_day == 0 && $hour_of_day >= 15 && $hour_of_day < 20)
        ? 13 : 11;
};

function get_cost_data($car_price, $tax_percentage, $base_price_policy, $is_base_policy = false)
{

    $COMISION_TAX = 17;

    $base_premium = $car_price + ($car_price * $base_price_policy / 100);

    $commision = $base_premium * $COMISION_TAX / 100;

    $tax = $base_premium * $tax_percentage / 100;

    return [
        'base_premium' => $is_base_policy ? $base_premium : "",
        'commision' => $commision,
        'tax' => $tax,
        'total_cost' => $base_premium + $commision + $tax

    ];
};

function calculate_insurance($car_price, $tax_percentage, $number_of_policies, $week_day, $hour_of_day)
{

    $base_price_policy = get_base_price_policy($week_day, $hour_of_day);

    $output_data = [
        'policy' => get_cost_data($car_price, $tax_percentage, $base_price_policy, true),
    ];

    $policy_price = $car_price / $number_of_policies;

    for ($i = 1; $i < $number_of_policies; $i++) {

        $output_data[$i . '_instalment'] = get_cost_data($policy_price, $tax_percentage, $base_price_policy);
    }

    return $output_data;
}

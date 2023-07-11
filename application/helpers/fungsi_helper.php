<?php

function check_already_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('idUser');
    if($user_session){
        redirect('dashboard');
    }
}

function check_not_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('idUser');
    if(!$user_session){
        redirect('auth/login');
    }
}

function check_admin(){ //Memberikan hak akses untuk user
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('dashboard_user');
    }
}

function check_user(){ //Memeberikan hak akses untuk admin
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 2) {
        redirect('dashboard');
    }
}

if (!function_exists('ej')) {
    function ej($params)
    {
        echo json_encode($params);

        exit;
    }
}

if (!function_exists('cvtPG')) {
    function cvtPG($params)
    {
        $params = strtolower($params);

        $grade = [
            'tidak ada' => 1,
            'pa+' => 2,
            'pa++' => 3,
            'pa+++' => 4,
            'pa++++' => 5,
        ];

        return $grade[$params];
    }
}

if (!function_exists('min_max_value')) {
    function min_max_value($arr, $index)
    {
        // Initialize variables to hold the max and min values
        $maxValue = PHP_INT_MIN; // Set to the smallest possible integer
        $minValue = PHP_INT_MAX; // Set to the largest possible integer

        // Iterate over the array to find max and min values
        foreach ($arr as $item) {
            $value = $item[$index];

            if ($value > $maxValue) {
                $maxValue = $value;
            }

            if ($value < $minValue) {
                $minValue = $value;
            }
        }

        // Return the max and min values in an array
        return ['max' => $maxValue, 'min' => $minValue];
    }
}

if (!function_exists('round_custom')) {
    function round_custom($number, $round, $on = false)
    {

        if($on){
            return round($number, $round);
        }else{
            return $number;
        }
    }
}

if (!function_exists('floor_down')) {
    function floor_down($number)
    {
        return floor($number * 100) / 100;
    }
}

if (!function_exists('safeDivision')) {
    function safeDivision($dividend, $divisor) {
        if ($divisor != 0) {
            $result = $dividend / $divisor;
        } else {
            $result = 0;
        }
        
        return $result;
    }
}
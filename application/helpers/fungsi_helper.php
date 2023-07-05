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
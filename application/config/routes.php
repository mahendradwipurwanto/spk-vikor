<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['rekomendasi'] = 'perhitungan/hasil';
$route['riwayat'] = 'perhitungan/riwayat';
$route['bobot-kriteria'] = 'dashboard/bobot_kriteria';

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;

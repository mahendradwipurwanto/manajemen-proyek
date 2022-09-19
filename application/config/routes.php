<?php
defined('BASEPATH') or exit('No direct script access allowed');

// AUTH
$route['masuk'] = 'authentication/login';
$route['keluar'] = 'api/auth/logout';
$route['daftar'] = 'authentication/register';
$route['register'] = 'authentication/register';
$route['lupa-password'] = 'authentication/lupa_password';
$route['reset-password/(:any)'] = 'authentication/reset_password/$1';
$route['verifikasi-email'] = 'authentication/verifikasi_email';

$route['default_controller'] = 'home';
$route['404_override'] = 'home/e_404';
$route['translate_uri_dashes'] = true;
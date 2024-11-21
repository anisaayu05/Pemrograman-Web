<?php

header("Content-Type: application/json; charset=UTF-8");

include_once "app/Routes/ServiceRoutes.php";

use app\Routes\ServiceRoutes;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = new ServiceRoutes();
$routes->handle($method, $path);

// Menambahkan header CORS untuk mengizinkan frontend dari port lain
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

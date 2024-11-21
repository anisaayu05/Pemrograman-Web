<?php

header("Content-Type: application/json; charset=UTF-8");

// Pastikan ini memuat file `ProductRoutes.php`
require_once __DIR__ . '/app/Routes/ProductRoutes.php';

use app\Routes\ProductRoutes;

// Tangkap method (GET, POST, dll.) dan path dari permintaan
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Panggil handler route
$productRoutes = new ProductRoutes();
$productRoutes->handle($method, $path);

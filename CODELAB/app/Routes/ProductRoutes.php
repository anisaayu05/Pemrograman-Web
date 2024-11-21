<?php
namespace app\Routes;

require_once __DIR__ . '/../Controller/ProductController.php';
use app\Controller\ProductController;

class ProductRoutes
{
    public function handle($method, $path)
    {
        error_log("Request Method: $method, Path: $path");

        // Route untuk GET /api/product
        if ($method === "GET" && $path === "/api/product") {
            error_log("Matched /api/product");
            $controller = new ProductController();
            echo $controller->index();
            return;
        }

        // Route untuk GET /api/product/{id}
        if ($method === "GET" && preg_match('/\/api\/product\/(\d+)/', $path, $matches)) {
            error_log("Matched /api/product/{id}");
            $controller = new ProductController();
            echo $controller->getById($matches[1]);
            return;
        }

        // Route untuk POST /api/product
        if ($method === "POST" && $path === "/api/product") {
            error_log("Matched POST /api/product");
            $controller = new ProductController();
            echo $controller->insert();
            return;
        }

        // Route untuk PUT /api/product/{id}
        if ($method === "PUT" && preg_match('/\/api\/product\/(\d+)/', $path, $matches)) {
            error_log("Matched PUT /api/product/{id}");
            $controller = new ProductController();
            echo $controller->update($matches[1]);
            return;
        }

        // Route untuk DELETE /api/product/{id}
        if ($method === "DELETE" && preg_match('/\/api\/product\/(\d+)/', $path, $matches)) {
            error_log("Matched DELETE /api/product/{id}");
            $controller = new ProductController();
            echo $controller->delete($matches[1]);
            return;
        }

        // Jika tidak ada route yang cocok
        header("HTTP/1.0 404 Not Found");
        echo json_encode(["message" => "Route not found"]);
    }
}

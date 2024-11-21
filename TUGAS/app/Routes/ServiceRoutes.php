<?php

namespace app\Routes;

include "app/Controller/ServiceController.php";

use app\Controller\ServiceController;

class ServiceRoutes
{
    public function handle($method, $path)
    {
        $controller = new ServiceController();

        if ($method === "GET" && $path === "/api/services") {
            echo $controller->index();
        } elseif ($method === "GET" && preg_match('/\/api\/services\/(\d+)/', $path, $matches)) {
            echo $controller->getById($matches[1]);
        } elseif ($method === "POST" && $path === "/api/services") {
            echo $controller->insert();
        } elseif ($method === "PUT" && preg_match('/\/api\/services\/(\d+)/', $path, $matches)) {
            echo $controller->update($matches[1]);
        } elseif ($method === "DELETE" && preg_match('/\/api\/services\/(\d+)/', $path, $matches)) {
            echo $controller->delete($matches[1]);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode(["message" => "Route not found"]);
        }
    }
}

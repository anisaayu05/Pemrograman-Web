<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Service.php";

use app\Models\Service;
use app\Traits\ApiResponseFormatter;

class ServiceController
{
    use ApiResponseFormatter;

    public function index()
    {
        $serviceModel = new Service();
        $response = $serviceModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $serviceModel = new Service();
        $response = $serviceModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($inputData['name'], $inputData['description'])) {
            return $this->apiResponse(400, "Invalid input", null);
        }

        $serviceModel = new Service();
        $id = $serviceModel->create($inputData);
        return $this->apiResponse(201, "Service created", ["id" => $id]);
    }

    public function update($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($inputData['name'], $inputData['description'])) {
            return $this->apiResponse(400, "Invalid input", null);
        }

        $serviceModel = new Service();
        $updated = $serviceModel->update($inputData, $id);
        return $this->apiResponse(200, "Service updated", $updated);
    }

    public function delete($id)
    {
        $serviceModel = new Service();
        $deleted = $serviceModel->delete($id);
        return $this->apiResponse(200, "Service deleted", $deleted);
    }
}
<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Product.php";

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController
{
    use ApiResponseFormatter;

    public function index()
    {
        // DEFINISI OBJEK MODEL PRODUCT YANG SUDAH DIBUAT
        $productModel = new Product();
        $response = $productModel->findAll();

        // RETURN $response DENGAN MELAKUKAN FORMATTING TERLEBIH DAHULU MENGGUNAKAN TRAIT YANG SUDAH DIPANGGIL
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $productModel = new Product();
        $response = $productModel->findById($id);

        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        // Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        // Validasi input valid atau tidak
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error: Invalid input", null);
        }

        $productModel = new Product();
        // Kirim data untuk ditambahkan
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);

        // Kembalikan respons dengan informasi produk yang baru ditambahkan
        return $this->apiResponse(200, "success", $response); // Pastikan $response berisi data yang valid
    }

    public function update($id)
    {
        // Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        // Validasi input valid atau tidak
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error: Invalid input", null);
        }

        // Cek apakah data produk_name ada di input
        if (!isset($inputData['product_name']) || empty($inputData['product_name'])) {
            return $this->apiResponse(400, "Error: Product name is required", null);
        }

        $productModel = new Product();
        // Update produk di database
        $response = $productModel->update([
            "product_name" => $inputData['product_name']
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $productModel = new Product();
        $response = $productModel->delete($id);

        if ($response) {
            return $this->apiResponse(200, "success", true);
        } else {
            return $this->apiResponse(404, "Product not found", null);
        }
    }
    }

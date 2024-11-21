<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig 
{
    public $conn;

    public function __construct() 
    {
        // connect ke database mysql
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        // check koneksi
        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    // Function menampilkan sebuah data
    public function findAll() 
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Function menampilkan data dengan id
    public function findById($id) 
    {
        $sql = "SELECT * FROM products where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Function untuk membuat sebuah data
    public function create($data)
    {
        $productName = $data['product_name'];
        $query = "INSERT INTO products (product_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $productName);
        $stmt->execute();

        // Ambil ID produk yang baru ditambahkan
        $insertedId = $this->conn->insert_id;
        $this->conn->close();

        // Kembalikan data produk yang baru ditambahkan
        return [
            "id" => $insertedId,
            "product_name" => $productName,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
    }

    // Function untuk update data
    public function update($data, $id)
    {
        $productName = $data['product_name'];
        $query = "UPDATE products SET product_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $productName, $id);
        $stmt->execute();

        // Ambil data produk yang baru diperbarui
        $query = "SELECT id, product_name, created_at, updated_at FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Periksa apakah ada data yang ditemukan
        if ($row = $result->fetch_assoc()) {
            $this->conn->close();

            // Kembalikan data produk yang diperbarui
            return [
                "id" => $row['id'],
                "product_name" => $row['product_name'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            ];
        }

        $this->conn->close();
        return null; // Jika tidak ada produk yang ditemukan
    }

    // Function delete data dengan id
    public function delete($id)
    {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;  // Produk berhasil dihapus
        }
        
        return false;  // Produk tidak ditemukan atau gagal dihapus
    }
    }

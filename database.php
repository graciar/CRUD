<?php
class DBConnection{
    private $conn;

    function __construct(){
        $config = require 'config.php';
        $username = $config['username'];
        $password = $config['password'];

        $this->conn = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $username, $password);
        // echo "Connection successful"; // Optional debug line
    }

    function __destruct(){
        $this->conn = null;
    }

    public function getUser(){
        $sql = "SELECT id, name, password FROM login";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result;    
    }

    public function getAllProduct(){
        $sql ="SELECT id, name, stock FROM products";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result;
    }

    public function addProduct($name, $stock){
        $sql = "INSERT INTO products(name, stock) VALUES(?,?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $stock]);
    }

    public function getProductbyId($id){
        $sql = "SELECT name, stock FROM products WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
        return $result;
    }

    public function transaction($product_id, $transaction_type, $qty){
        $sql = "INSERT INTO transactions(product_id, transaction_type, quantity) VALUES (?, ?, ?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$product_id, $transaction_type, $qty]);
        return $result;
    }

    public function updateQty($id, $qty){
        $sql = "UPDATE products SET stock = ? WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$qty, $id]);
    }

    public function updateProduct($name, $stock, $id){
        $sql = "UPDATE product set name = ?, stock = ? WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $stock, $id]);
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM products WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
        return $result;
    }

}
?>
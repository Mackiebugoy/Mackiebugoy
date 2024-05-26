<?php
require_once 'DB.php';

class Product extends DB {
    public function addProduct($data) {
        $sql = "INSERT INTO products (name, description, price, quantity, stock, size, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('ssdiiss', $data['name'], $data['description'], $data['price'], $data['quantity'], $data['stock'], $data['size'], $data['image']);
        return $stmt->execute();
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        return $this->query($sql);
    }
}
?>


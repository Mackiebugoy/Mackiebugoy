<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssds", $this->name, $this->description, $this->price, $this->image);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

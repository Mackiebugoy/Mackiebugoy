<?php
class Order {
    private $conn;
    private $table_name = "orders";

    public $id;
    public $user_id;
    public $total_price;
    public $status;
    public $order_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new order
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, total_price, status, order_date) VALUES (:user_id, :total_price, :status, :order_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":total_price", $this->total_price);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":order_date", $this->order_date);

        return $stmt->execute();
    }

    // Read orders
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update order
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET user_id = :user_id, total_price = :total_price, status = :status, order_date = :order_date WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':order_date', $this->order_date);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete order
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>

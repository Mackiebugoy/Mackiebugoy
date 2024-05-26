<?php
require_once 'DB.php';

class Purchase extends DB {
    public function buyProduct($user_id, $product_id, $quantity) {
        $sql = "INSERT INTO purchases (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('iii', $user_id, $product_id, $quantity);
        return $stmt->execute();
    }

    public function getPurchasesByUser($user_id) {
        $sql = "SELECT p.*, pr.name FROM purchases p JOIN products pr ON p.product_id = pr.id WHERE p.user_id = ?";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function cancelPurchase($purchase_id) {
        $sql = "DELETE FROM purchases WHERE id = ?";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $purchase_id);
        return $stmt->execute();
    }
}
?>

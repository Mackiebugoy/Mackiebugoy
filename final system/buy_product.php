<?php
require_once 'Purchase.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $purchase = new Purchase();
    $purchase->buyProduct($_SESSION['user']['id'], $_POST['product_id'], 1); // Assume quantity is 1 for simplicity
    header('Location: my_purchases.php');
}
?>

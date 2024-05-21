<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_ids = array_keys($cart);
$sql = "SELECT * FROM products WHERE id IN (" . implode(',', $product_ids) . ")";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

$total = 0;
foreach ($products as $product) {
    $total += $product['price'] * $cart[$product['id']];
}

$sql = "INSERT INTO orders (user_id, total) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $user_id, $total);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

foreach ($products as $product) {
    $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $order_id, $product['id'], $cart[$product['id']], $product['price']);
    $stmt->execute();
    $stmt->close();
}

unset($_SESSION['cart']);
header("Location: order_success.php");
?>

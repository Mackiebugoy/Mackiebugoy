<?php
session_start();
include 'header.php';
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$product_id = $_GET['id'];
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cart[$product_id] = isset($cart[$product_id]) ? $cart[$product_id] + 1 : 1;
$_SESSION['cart'] = $cart;

header("Location: cart.php");
?>

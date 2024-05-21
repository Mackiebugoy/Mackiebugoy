<?php
session_start();
include 'header.php';
include 'config.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$product_ids = array_keys($cart);
if (empty($product_ids)) {
    $products = [];
} else {
    $sql = "SELECT * FROM products WHERE id IN (" . implode(',', $product_ids) . ")";
    $result = $conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
}

$total = 0;
foreach ($products as $product) {
    $total += $product['price'] * $cart[$product['id']];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cart</h2>
        <?php if (empty($products)): ?>
            <p>Your cart is empty</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td>$<?php echo $product['price']; ?></td>
                            <td><?php echo $cart[$product['id']]; ?></td>
                            <td>$<?php echo $product['price'] * $cart[$product['id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>$<?php echo $total; ?></td>
                    </tr>
                </tfoot>
            </table>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>

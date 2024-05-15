<?php
session_start();
require_once '../config/Database.php';
require_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

include_once '../templates/header.php';
?>

<h2>Shopping Cart</h2>
<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_price = 0;
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $product = new Product($db);
                $product->id = $product_id;
                $product_data = $product->read()->fetch(PDO::FETCH_ASSOC);

                $price = $product_data['price'];
                $total = $price * $quantity;
                $total_price += $total;
            ?>
                <tr>
                    <td><?php echo $product_data['name']; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>$<?php echo $price; ?></td>
                    <td>$<?php echo $total; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Total Price</td>
                <td>$<?php echo $total_price; ?></td>
            </tr>
        </tbody>
    </table>
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<?php include_once '../templates/footer.php'; ?>

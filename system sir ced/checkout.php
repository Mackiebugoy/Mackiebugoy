<?php
session_start();
require_once 'C/xampp/htdocs/Database.php';
require_once '../classes/Order.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order = new Order($db);
    $order->user_id = $_SESSION['user_id'];
    $order->total_price = $_POST['total_price'];
    $order->status = "Pending";
    $order->order_date = date('Y-m-d H:i:s');

    if ($order->create()) {
        unset($_SESSION['cart']);
        echo "Order placed successfully.";
    } else {
        echo "Order placement failed.";
    }
}

include_once '../templates/header.php';
?>

<h2>Checkout</h2>
<form action="checkout.php" method="post">
    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
    <button type="submit" class="btn btn-primary">Confirm Order</button>
</form>

<?php include_once '../templates/footer.php'; ?>

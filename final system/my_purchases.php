<?php
include 'header.php';
require_once 'Purchase.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$purchase = new Purchase();

if (isset($_POST['cancel'])) {
    $purchase->cancelPurchase($_POST['purchase_id']);
    echo "<p>Purchase canceled successfully!</p>";
}

$purchases = $purchase->getPurchasesByUser($_SESSION['user']['id']);
?>

<h2>My Purchases</h2>
<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Purchase Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $purchases->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['purchase_date']); ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="purchase_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>

<?php
include 'header.php';
require_once 'Product.php';

$product = new Product();
$products = $product->getAllProducts();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Available Products</h2>
    <div class="row">
        <?php while ($row = $products->fetch_assoc()): ?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                    <p class="card-text">Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                    <form method="POST" action="buy_product.php">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-primary">Buy</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>

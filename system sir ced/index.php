<?php
session_start();
require_once '../config/Database.php';
require_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$products = $product->read();

include_once '../templates/header.php';
?>

<h2>Products</h2>
<div class="row">
    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="col-md-4">
            <div class="card">
                <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <p class="card-text">$<?php echo $row['price']; ?></p>
                    <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php include_once '../templates/footer.php'; ?>

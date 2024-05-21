<?php
require_once 'Database.php';
require_once 'Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$result = $product->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Products</h1>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text">$<?php echo $row['price']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No products found";
            }
            ?>
        </div>
    </div>
</body>
</html>

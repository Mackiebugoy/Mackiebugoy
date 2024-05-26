<?php
include 'header.php';
require_once 'Product.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'stock' => $_POST['stock'],
        'size' => $_POST['size'],
        'image' => $_FILES['image']['name']
    ];

    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $_FILES['image']['name']);

    $product->addProduct($data);
    echo "<p>Product added successfully!</p>";
}
?>

<h2>Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" required>
    </div>
    <div class="mb-3">
        <label for="size" class="form-label">Size</label>
        <input type="text" class="form-control" id="size" name="size" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>

<?php include 'footer.php'; ?>

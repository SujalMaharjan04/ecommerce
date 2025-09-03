<?php
include '../db_connect.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Handle Image Upload
    $target_dir = "../uploads/";
    $image = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);

    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdis", $name, $price, $stock, $image);
    
    if ($stmt->execute()) {
        header("Location: products.php");
    } else {
        echo "Error adding product!";
    }
}
?>

<div class="container mt-4">
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

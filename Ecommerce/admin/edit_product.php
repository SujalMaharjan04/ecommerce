<?php
include '../db_connect.php';
include 'includes/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=? WHERE id=?");
    $stmt->bind_param("sdii", $name, $price, $stock, $id);
    
    if ($stmt->execute()) {
        header("Location: products.php");
    } else {
        echo "Error updating product!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Product</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="<?= $product['price'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

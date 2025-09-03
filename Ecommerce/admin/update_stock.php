<?php
include '../db_connect.php';
include 'includes/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newStock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE products SET stock=? WHERE id=?");
    $stmt->bind_param("ii", $newStock, $id);
    
    if ($stmt->execute()) {
        header("Location: stock_management.php");
    } else {
        echo "Error updating stock!";
    }
}
?>

<div class="container mt-4">
    <h2>Update Stock for <?= $product['name'] ?></h2>
    <form method="POST">
        <div class="mb-3">
            <label>New Stock Quantity</label>
            <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update Stock</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

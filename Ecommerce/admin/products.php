<?php
include '../db_connect.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM products");
?>

<div class="container mt-4">
    <h2>Manage Products</h2>
    <a href="add_product.php" class="btn btn-primary mb-3">Add Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Image</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td>₹<?= $row['price'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td><img src="<?= $row['image'] ?>" width="50"></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

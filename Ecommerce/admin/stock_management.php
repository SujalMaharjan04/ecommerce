<?php
include '../db_connect.php';
include 'includes/header.php';

// Get all products
$result = $conn->query("SELECT * FROM products ORDER BY stock ASC");
?>

<div class="container mt-4">
    <h2>Stock Management</h2>

    <!-- Low Stock Alert -->
    <div class="alert alert-warning">
        <strong>Note:</strong> Products with stock ≤ 5 are marked as low stock.
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="<?= $row['stock'] <= 5 ? 'table-danger' : '' ?>">
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td>$<?= $row['price'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td>
                    <a href="update_stock.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Update Stock</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

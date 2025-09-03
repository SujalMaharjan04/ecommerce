<?php
include '../db_connect.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<div class="container mt-4">
    <h2>Manage Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th><th>Customer</th><th>Email</th><th>Total Price</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>$<?= $row['total_price'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="update_order.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Update</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

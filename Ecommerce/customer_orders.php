<?php
session_start();
include 'db_connect.php';

$email = $_SESSION['email']; // Get customer email from session
$result = $conn->query("SELECT * FROM orders WHERE email = '$email' ORDER BY created_at DESC");
?>

<div class="container mt-4">
    <h2>Your Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th><th>Total Price</th><th>Status</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td>$<?= $row['total_price'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

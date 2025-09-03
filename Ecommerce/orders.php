<?php
session_start();
include 'db_connect.php';
include 'includes/header.php';

// Replace with actual user authentication (assuming user email is stored in session)
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email']; // Get logged-in user email
$result = $conn->query("SELECT * FROM orders WHERE email = '$email' ORDER BY created_at DESC");
?>

<div class="container mt-4">
    <h2 class="text-center">Your Orders</h2>

    <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th><th>Total Price</th><th>Status</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><a href="order_details.php?order_id=<?= $row['id'] ?>">#<?= $row['id'] ?></a></td>
                <td>$<?= number_format($row['total_price'], 2) ?></td>
                <td>
                    <span class="badge bg-<?= $row['status'] == 'Delivered' ? 'success' : ($row['status'] == 'Shipped' ? 'info' : 'warning') ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>
                <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center">You have no orders yet.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

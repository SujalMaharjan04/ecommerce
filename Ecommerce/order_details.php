<?php
session_start();
include 'db_connect.php';
include 'includes/header.php';

if (!isset($_GET['order_id'])) {
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['order_id'];
$orderQuery = $conn->query("SELECT * FROM orders WHERE id = $order_id");
$order = $orderQuery->fetch_assoc();

if (!$order) {
    echo "<div class='container mt-5'><h3>Order not found.</h3></div>";
    include 'includes/footer.php';
    exit();
}
?>

<div class="container mt-4">
    <h2>Order Details</h2>
    <p><strong>Order ID:</strong> #<?= $order['id'] ?></p>
    <p><strong>Total Price:</strong> $<?= number_format($order['total_price'], 2) ?></p>
    <p><strong>Status:</strong> <?= $order['status'] ?></p>
    <p><strong>Date:</strong> <?= date("d M Y", strtotime($order['created_at'])) ?></p>
    
    <a href="orders.php" class="btn btn-primary">Back to Orders</a>
</div>

<?php include 'includes/footer.php'; ?>

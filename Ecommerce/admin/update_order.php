<?php
include '../db_connect.php';
include 'includes/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM orders WHERE id = $id");
$order = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        header("Location: orders.php");
    } else {
        echo "Error updating order!";
    }
}
?>

<div class="container mt-4">
    <h2>Update Order Status</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Order ID: <?= $order['id'] ?></label>
        </div>
        <div class="mb-3">
            <label>Customer Name: <?= $order['customer_name'] ?></label>
        </div>
        <div class="mb-3">
            <label>Email: <?= $order['email'] ?></label>
        </div>
        <div class="mb-3">
            <label>Total Price: $<?= $order['total_price'] ?></label>
        </div>
        <div class="mb-3">
            <label>Order Status</label>
            <select name="status" class="form-control">
                <option value="Pending" <?= ($order['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                <option value="Shipped" <?= ($order['status'] == 'Shipped') ? 'selected' : '' ?>>Shipped</option>
                <option value="Delivered" <?= ($order['status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Status</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

<?php
session_start();
include '../db_connect.php';

// Validate POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../checkout.php");
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$total_price = $_POST['total_price'];
$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];

// Insert order into database
$stmt = $conn->prepare("INSERT INTO orders (customer_name, email, address, total_price, status) VALUES (?, ?, ?, ?, 'Pending')");
$stmt->bind_param("sssd", $name, $email, $address, $total_price);
$stmt->execute();
$order_id = $stmt->insert_id;

// Deduct stock and clear cart
foreach ($product_ids as $index => $product_id) {
    $quantity = $quantities[$index];

    // Reduce stock
    $updateStock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    $updateStock->bind_param("ii", $quantity, $product_id);
    $updateStock->execute();
}

// Clear cart
unset($_SESSION['cart']);

// Redirect to order success page
header("Location: ../order_success.php?order_id=" . $order_id);
exit();
?>

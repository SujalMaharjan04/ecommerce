<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['name'];
    $email = $_POST['email'];
    $total_price = $_POST['total_price'];
    $product_id = $_POST['product_id'];  // Product being purchased
    $quantity = $_POST['quantity'];  // Quantity being ordered

    // Insert Order
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, email, total_price, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("ssd", $customer_name, $email, $total_price);
    $stmt->execute();

    // Reduce Stock
    $updateStock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    $updateStock->bind_param("ii", $quantity, $product_id);
    $updateStock->execute();

    echo "Order placed successfully!";
}
?>

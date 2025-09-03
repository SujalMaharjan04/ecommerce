<?php
session_start();
include '../db_connect.php';

// Check if product ID is set
if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    header("Location: ../cart.php");
    exit();
}

$product_id = $_POST['product_id'];
$quantity = (int)$_POST['quantity'];

// Ensure cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add or update product quantity in cart
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = $quantity;
}

// Redirect to cart page
header("Location: ../cart.php");
exit();
?>

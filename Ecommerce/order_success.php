<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/header.php';
?>

<style>
    .thank-you-container {
        background: #f8f9fa;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
        display: inline-block;
    }
    .thank-you-container h2 {
        color: #28a745;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-5 text-center">
    <div class="thank-you-container">
        <h2>Thank You!</h2>
        <p>Your order has been placed successfully.</p>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

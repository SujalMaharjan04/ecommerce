<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/header.php';

// Simulate eSewa POST if running on localhost
$simulate_esewa = true;  // toggle to true for local testing

$transaction_id = $_POST['transaction_uuid'] ?? 'TEST123456';
$total_amount = $_POST['total_amount'] ?? 100;
$product_code = $_POST['product_code'] ?? 'EPAYTEST';

if (!$simulate_esewa) {
    // Real verification (for public URL / production)
    $verify_url = "https://uat.esewa.com.np/epay/transrec";
    $post_data = [
        'amt' => $total_amount,
        'rid' => $transaction_id,
        'pid' => $product_code,
        'scd' => 'YOUR_MERCHANT_CODE'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $verify_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    $payment_verified = strpos($response, "Success") !== false;
} else {
    // Local testing: assume success
    $payment_verified = true;
}
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
        <h2><?= $payment_verified ? "Thank You!" : "Failed" ?></h2>
        <p><?= $payment_verified ? "Your order has been placed successfully." : "Your order has not been placed. Please Try again." ?></p>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

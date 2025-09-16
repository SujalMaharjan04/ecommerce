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

// Esewa Integration
//Configuration
$secret = '8gBm/:&EnhH.1/q'; //test secret key-> esewa docs
$product_code = 'EPAYTEST';//test code from esewa

$failure = '###'; // add a failure page

//Transaction Details
$amount = $total_price;
$tax_amount = '10';
$total_amount = $amount+ $tax_amount;
$transaction_uuid = uniqid('txn_');


//prepare signed fields 
$signed_field_names = 'total_amount,transaction_uuid,product_code';
$date_to_sign = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";

//hash the signature
$signature = base64_encode(hash_hmac('sha256', $date_to_sign, $secret, true));


// Insert order into database
$stmt = $conn->prepare("INSERT INTO orders (customer_name, email, address, total_price, status) VALUES (?, ?, ?, ?, 'Pending')");
$stmt->bind_param("sssd", $name, $email, $address, $total_price);
$stmt->execute();
$order_id = $stmt->insert_id;

//Success Page
$success = 'https://localhost/ecommerce/order_success.php?order_id=' . $order_id;



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
// header("Location: ../order_success.php?order_id=" . $order_id);
// exit();
?>

<body>
    <form id = "esewa-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST"> <!--Change the action to new url given by esewa for production -->
        <input type="hidden" id="amount" name="amount" value="<?= $amount ?>" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value ="<?= $tax_amount ?>" required>
        <input type="hidden" id="total_amount" name="total_amount" value="<?= $total_amount ?>" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?= $transaction_uuid ?>" required>
        <input type="hidden" id="product_code" name="product_code" value ="<?= $product_code ?>" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value= <?= $success ?> required>
        <input type="hidden" id="failure_url" name="failure_url" value="https://developer.esewa.com.np/failure" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" value="<?= $signature ?>" required>
    </form>

    <script>
        document.getElementById('esewa-form').submit()
    </script>
</body>

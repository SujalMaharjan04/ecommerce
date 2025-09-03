<?php
session_start();
include 'db_connect.php';
include 'includes/header.php';

// If cart is empty, redirect to shop page
if (empty($_SESSION['cart'])) {
    header("Location: shop.php");
    exit();
}

// Fetch cart items
$cart_items = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $total_price += $row['subtotal'];
        $cart_items[] = $row;
    }
}

// Esewa Integration
//Configuration
$secret = '8gBm/:&EnhH.1/q'; //test secret key-> esewa docs
$product_code = 'EPAYTEST';//test code from esewa
$success = '###'; //add a success page 
$failure = '###'; // add a failure page

//Transaction Details
$amount = '100';
$tax_amount = '10';
$total_amount = $amount + $tax_amount;
$transaction_uuid = uniqid('txn_');


//prepare signed fields 
$signed_field_names = 'total_amount_transaction_uuid,product_code';
$date_to_sign = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";

//hash the signature
$signature = base64_encode(hash_hmac('sha256', $date_to_sign, $secret, true));
?>

<style>
    .checkout-container {
        animation: fadeIn 0.8s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* Ensure labels are visible */
    .form-label {
        font-weight: bold;
        color: #333;
    }
    .h2,h4{
        color: Black;
    }
</style>

<div class="container mt-4 checkout-container">
    <h2 class="text-center" style="color:Black">Checkout</h2>

    <form action="process/place_order.php" method="POST">
        <!-- Shipping Details -->
        <h4>Shipping Details</h4>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>

        <!-- Order Summary -->
        <h4>Order Summary</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th><th>Quantity</th><th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>₹<?= number_format($item['subtotal'], 2) ?></td>
                </tr>
                <input type="hidden" name="product_id[]" value="<?= $item['id'] ?>">
                <input type="hidden" name="quantity[]" value="<?= $item['quantity'] ?>">
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4 class="text-end">Total: ₹<?= number_format($total_price, 2) ?></h4>
        <input type="hidden" name="total_price" value="<?= $total_price ?>">

        <button type="submit" class="btn btn-success w-100 mt-3">Place Order</button>
    </form>

    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST"> <!--Change the action to new url given by esewa for production -->
        <input type="hidden" id="amount" name="amount" value="<?= $amount ?>" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value ="<?= $tax_amount ?>" required>
        <input type="hidden" id="total_amount" name="total_amount" value="<?= $total_amount ?>" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?= $transaction_uuid ?>" required>
        <input type="hidden" id="product_code" name="product_code" value ="<?= $product_code ?>" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value="https://developer.esewa.com.np/success" required>
        <input type="hidden" id="failure_url" name="failure_url" value="https://developer.esewa.com.np/failure" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" value="<?= $signature ?>" required>
        <button type = "submit">Pay with Esewa</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

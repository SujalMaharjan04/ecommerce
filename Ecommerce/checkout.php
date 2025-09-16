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

    
</div>

<?php include 'includes/footer.php'; ?>

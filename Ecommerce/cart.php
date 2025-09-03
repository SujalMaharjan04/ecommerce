<?php
// session_start(); - comment due to navbar not align
include 'db_connect.php';
include 'includes/header.php';

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle remove from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}

// Handle update quantity
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $id => $qty) {
        if ($qty > 0) {
            $_SESSION['cart'][$id] = $qty;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
}

// Fetch cart products
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
    .cart-container {
        animation: fadeIn 0.8s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-4 cart-container">
    <h2 class="text-center" style= "color:black">Shopping Cart</h2>

    <?php if (empty($cart_items)): ?>
        <p class="text-center" style= "color:black">Your cart is empty.</p>
    <?php else: ?>
        <form method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td>₹<?= number_format($item['price'], 2) ?></td>
                        <td>
                            <input type="number" name="quantity[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="form-control w-50">
                        </td>
                        <td>₹<?= number_format($item['subtotal'], 2) ?></td>
                        <td>
                            <a href="cart.php?remove=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4 class="text-end">Total: ₹<?= number_format($total_price, 2) ?></h4>
            <div class="text-end">
                <button type="submit" name="update_cart" class="btn btn-warning">Update Cart</button>
                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

<?php
include 'db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "<div class='container mt-5'><h3>Product not found.</h3></div>";
    include 'includes/footer.php';
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "<div class='container mt-5'><h3>Product not found.</h3></div>";
    include 'includes/footer.php';
    exit();
}
?>

<style>
    /* Product Page Styling */
    .product-container {
        animation: fadeIn 0.8s ease-in-out;
    }
    .product-img {
        width: 100%;
        max-height: 350px;
        object-fit: contain;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        background: #f8f8f8;
    }
    .btn-add-to-cart {
        transition: 0.3s ease;
    }
    .btn-add-to-cart:hover {
        transform: scale(1.05);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-4 product-container">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 text-center">
            <img src="uploads/<?= $product['image'] ?>" class="product-img" alt="<?= $product['name'] ?>">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <h4 class="text-success">₹<?= number_format($product['price'], 2) ?></h4>
            <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($product['description'])) ?></p>

            <?php if ($product['stock'] > 0): ?>
                <p class="text-success"><strong>In Stock:</strong> <?= $product['stock'] ?> available</p>
                <form action="process/add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <label><strong>Quantity:</strong></label>
                    <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" class="form-control w-25 mb-3">
                    <button type="submit" class="btn btn-primary btn-add-to-cart">Add to Cart</button>
                </form>
            <?php else: ?>
                <p class="text-danger"><strong>Out of Stock</strong></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
include 'db_connect.php';
include 'includes/header.php';

// Fetch Featured Products (Limit 6)
$products = $conn->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 6");
?>

<style>
    /* Ensure cards have dynamic heights */
    .card {
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-body {
        flex-grow: 1;
    }
    /* Button stays at the bottom */
    .card .btn {
        margin-top: auto;
    }
    /* Hover effect */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }
    /* Ensure images have a fixed height while maintaining aspect ratio */
    .card-img-top {
        height: 200px;
        object-fit: scale-down; /* Crops image to fit */
    }
</style>

<div class="container mt-4">
    <!-- Hero Banner -->
    <div class="jumbotron text-center bg-primary text-white py-5">
        <h1>Welcome to Techommerce</h1>
        <p>Find the best products at unbeatable prices!</p>
        <a href="shop.php" class="btn btn-light btn-lg">Shop Now</a>
    </div>

    <!-- Featured Products -->
    <h2 class="text-center mt-4">Featured Products</h2>
    <div class="row">
        <?php while ($product = $products->fetch_assoc()): ?>
        <div class="col-md-4 d-flex">
            <div class="card mb-4 w-100">
                <img src="uploads/<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class="card-text">₹<?= number_format($product['price'], 2) ?></p>
                    <a href="product.php?id=<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

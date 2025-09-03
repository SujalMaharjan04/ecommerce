<?php
include 'db_connect.php';
include 'includes/header.php';

// Fetch categories for filter dropdown
$categories = $conn->query("SELECT * FROM categories");

// Handle filters
$category_filter = isset($_GET['category']) ? "AND category_id = " . $_GET['category'] : "";
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : "newest"; 

// Sorting Logic
$order_by = "ORDER BY created_at DESC"; // Default: Newest
if ($sort_order == "low_high") {
    $order_by = "ORDER BY price ASC";
} elseif ($sort_order == "high_low") {
    $order_by = "ORDER BY price DESC";
}

// Fetch products with filters
$products = $conn->query("SELECT * FROM products WHERE 1 $category_filter $order_by");
?>

<style>
    /* Shop Page Styling */
    .shop-container {
        animation: fadeIn 0.8s ease-in-out;
    }

    /* Product Cards */
    .card {
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-body {
        flex-grow: 1;
    }
    .card .btn {
        margin-top: auto;
    }
    
    /* Card Hover Effect */
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
    }

    /* Filter & Sorting Section */
    .filter-bar {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-4 shop-container">
    <h2 class="text-center">Shop</h2>

    <!-- Filter & Sorting Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="filter-bar">
                <form method="GET">
                    <label>Category:</label>
                    <select name="category" class="form-control" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php while ($cat = $categories->fetch_assoc()): ?>
                            <option value="<?= $cat['id'] ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= $cat['name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="filter-bar">
                <form method="GET">
                    <label>Sort By:</label>
                    <select name="sort" class="form-control" onchange="this.form.submit()">
                        <option value="newest" <?= ($sort_order == "newest") ? 'selected' : '' ?>>Newest</option>
                        <option value="low_high" <?= ($sort_order == "low_high") ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="high_low" <?= ($sort_order == "high_low") ? 'selected' : '' ?>>Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Product Listing -->
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

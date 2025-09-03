<?php
include '../db_connect.php';
include 'includes/header.php';

// Get Total Revenue
$totalRevenueQuery = $conn->query("SELECT SUM(total_price) AS revenue FROM orders WHERE status = 'Delivered'");
$totalRevenue = $totalRevenueQuery->fetch_assoc()['revenue'] ?? 0;

// Filter Sales by Date Range
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';
$dateFilter = '';

if ($startDate && $endDate) {
    $dateFilter = "AND created_at BETWEEN '$startDate' AND '$endDate'";
}

$salesQuery = $conn->query("SELECT * FROM orders WHERE status = 'Delivered' $dateFilter ORDER BY created_at DESC");

// Get Top-Selling Products
$topProductsQuery = $conn->query("
    SELECT p.name, SUM(o.total_price) AS total_sales 
    FROM orders o 
    JOIN products p ON o.id = p.id 
    WHERE o.status = 'Delivered' 
    GROUP BY p.name 
    ORDER BY total_sales DESC 
    LIMIT 5
");
?>

<div class="container mt-4">
    <h2>Sales Reports & Revenue Tracking</h2>
    
    <!-- Total Revenue -->
    <div class="alert alert-success">
        <h4>Total Revenue: $<?= number_format($totalRevenue, 2) ?></h4>
    </div>

    <!-- Filter Sales by Date -->
    <form method="GET" class="mb-3">
        <label>Start Date:</label>
        <input type="date" name="start_date" value="<?= $startDate ?>" class="form-control mb-2">
        <label>End Date:</label>
        <input type="date" name="end_date" value="<?= $endDate ?>" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Sales List -->
    <h4>Sales Data</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th><th>Customer</th><th>Total Price</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $salesQuery->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td>$<?= $row['total_price'] ?></td>
                <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Top-Selling Products -->
    <h4>Top-Selling Products</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th><th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $topProductsQuery->fetch_assoc()): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td>$<?= number_format($row['total_sales'], 2) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

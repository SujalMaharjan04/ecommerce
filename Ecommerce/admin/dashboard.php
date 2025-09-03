<?php
include '../db_connect.php';
include 'includes/header.php';

// Fetch Total Products
$totalProductsQuery = $conn->query("SELECT COUNT(*) AS total FROM products");
$totalProducts = $totalProductsQuery->fetch_assoc()['total'];

// Fetch Total Orders
$totalOrdersQuery = $conn->query("SELECT COUNT(*) AS total FROM orders");
$totalOrders = $totalOrdersQuery->fetch_assoc()['total'];

// Fetch Total Revenue (Only Delivered Orders)
$totalRevenueQuery = $conn->query("SELECT SUM(total_price) AS revenue FROM orders WHERE status = 'Delivered'");
$totalRevenue = $totalRevenueQuery->fetch_assoc()['revenue'] ?? 0;

// Fetch Low Stock Products
$lowStockQuery = $conn->query("SELECT COUNT(*) AS low_stock_count FROM products WHERE stock <= 5");
$lowStockCount = $lowStockQuery->fetch_assoc()['low_stock_count'];

// Fetch Recent Orders (Last 5)
$recentOrders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");

// Fetch Total Users
$totalUsersQuery = $conn->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = $totalUsersQuery->fetch_assoc()['total'];

// Fetch Total Admins
$totalAdminsQuery = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'admin'");
$totalAdmins = $totalAdminsQuery->fetch_assoc()['total'];

// Fetch Total Customers
$totalCustomersQuery = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'customer'");
$totalCustomers = $totalCustomersQuery->fetch_assoc()['total'];

// Fetch Sales Reports
$todaySalesQuery = $conn->query("SELECT SUM(total_price) AS sales FROM orders WHERE status = 'Delivered' AND DATE(created_at) = CURDATE()");
$todaySales = $todaySalesQuery->fetch_assoc()['sales'] ?? 0;

$monthSalesQuery = $conn->query("SELECT SUM(total_price) AS sales FROM orders WHERE status = 'Delivered' AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
$monthSales = $monthSalesQuery->fetch_assoc()['sales'] ?? 0;

$totalSalesQuery = $conn->query("SELECT SUM(total_price) AS sales FROM orders WHERE status = 'Delivered'");
$totalSales = $totalSalesQuery->fetch_assoc()['sales'] ?? 0;
?>

<div class="container mt-4">
    <h2>Admin Dashboard</h2>

    <div class="row">
        <!-- Total Products -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?= $totalProducts ?></p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?= $totalOrders ?></p>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">₹<?= number_format($totalRevenue, 2) ?></p>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?= $totalUsers ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <?php if ($lowStockCount > 0): ?>
    <div class="alert alert-danger">
        <strong>Low Stock Warning:</strong> <?= $lowStockCount ?> products need restocking. 
        <a href="stock_management.php" class="btn btn-warning btn-sm">Manage Stock</a>
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- Total Admins -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text"><?= $totalAdmins ?></p>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text"><?= $totalCustomers ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Reports -->
    <h4>Sales Reports</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Today's Sales</h5>
                    <p class="card-text">₹<?= number_format($todaySales, 2) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">This Month's Sales</h5>
                    <p class="card-text">₹<?= number_format($monthSales, 2) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text">₹<?= number_format($totalSales, 2) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <h4>Recent Orders</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th><th>Customer</th><th>Total Price</th><th>Status</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $recentOrders->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td>₹<?= number_format($row['total_price'], 2) ?></td>
                <td>
                    <span class="badge bg-<?= $row['status'] == 'Delivered' ? 'success' : ($row['status'] == 'Shipped' ? 'info' : 'warning') ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>
                <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

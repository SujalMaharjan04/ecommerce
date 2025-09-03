<?php
include '../db_connect.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM users WHERE role = 'customer'");
?>

<div class="container mt-4">
    <h2>Manage Customers</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Registered On</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
                <td>
                    <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

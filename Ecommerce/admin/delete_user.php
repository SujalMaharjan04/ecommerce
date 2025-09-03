<?php
include '../db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ensure an admin is not deleted
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'customer'");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: users.php");
    } else {
        echo "Error deleting user!";
    }
}
?>

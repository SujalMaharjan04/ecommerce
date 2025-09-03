</div> <!-- Closing tag for content wrapper (from header.php) -->

<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>

    html, body {
        height: 100%;
    }
    .wrapper {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }
    .content {
        flex: 1;
    }
    .footer {
        position: relative;
        bottom: 0;
        width: 100%;
    }

</style>

</head>
<body>

<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <!-- Quick Links -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="shop.php" class="text-light text-decoration-none">Shop</a></li>
                    <li><a href="about.php" class="text-light text-decoration-none">About Us</a></li>
                    <li><a href="contact.php" class="text-light text-decoration-none">Contact</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>Email: support@Techommerce.com</p>
                <p>Phone: +977 9849192939</p>
            </div>
            
            <!-- Social Media -->
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <a href="#" class="text-light me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-2"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-light me-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="text-center mt-3">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Techommerce. All Rights Reserved.</p>
        </div>
    </div>
</footer>

    
</body>
</html>



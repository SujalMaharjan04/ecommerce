<?php
include 'includes/header.php';
?>

<style>
    .contact-container {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
    }
    .contact-container h2 {
        color: #007bff;
        text-align: center;
    }
    .contact-info {
        text-align: justify;
        margin-bottom: 20px;
        color: Black;
        padding: 20px;
    }
    .form-control {
        margin-bottom: 15px;
    }
    /* Ensure labels are visible */
    .form-label {
        font-weight: bold;
        color: #333;
        display: block;
    }
    /* Google Map */
    .map-container {
        margin-top: 20px;
        width: 100%;
        height: 350px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-5">
    <div class="contact-container">
        <h2>Contact Us</h2>

        <!-- Contact Info -->
        <div class="contact-info">
            <p><strong>Email:</strong> support@yourshop.com</p>
            <p><strong>Phone:</strong> +1 234 567 890</p>
            <p><strong>Address:</strong> 123 Main Street, Your City, Your Country</p>
        </div>

        <!-- Contact Form -->
        <form action="process/contact_form.php" method="POST">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>

            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>

            <label for="message" class="form-label">Message</label>
            <textarea id="message" name="message" class="form-control" required></textarea>

            <button type="submit" class="btn btn-primary w-100">Send Message</button>
        </form>

        <!-- Google Map -->
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093643!2d144.9537363155047!3d-37.81720974202132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e33!2sMelbourne%20CBD%2C%20VIC%2C%20Australia!5e0!3m2!1sen!2sin!4v1631537046723!5m2!1sen!2sin" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

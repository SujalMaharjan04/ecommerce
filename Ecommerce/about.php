<?php
include 'includes/header.php';
?>

<style>
    .about-container {
        max-width: 900px;
        margin: auto;
        padding: 30px;
        background: #ffffff; /* White background for better readability */
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
        color: #333; /* Darker text for visibility */
    }
    .about-container h2, .about-container h4 {
        color: #007bff;
        text-align: center;
    }
    .about-section {
        margin-bottom: 30px;
        padding: 15px;
        background: #f8f9fa; /* Light gray background */
        border-radius: 8px;
    }
    .testimonial {
        background: #ffffff;
        padding: 15px;
        border-left: 5px solid #007bff; /* Blue border for emphasis */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .testimonial p {
        font-style: italic;
        color: #555; /* Darker gray for readability */
    }
    .testimonial strong {
        display: block;
        margin-top: 10px;
        color: #007bff;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-5">
    <div class="about-container">
        <h2>About Us</h2>

        <!-- Company Information -->
        <div class="about-section">
            <h4>Our Story</h4>
            <p>Welcome to YourShop, your number one source for all things tech. We're dedicated to providing you the best products, with a focus on quality, affordability, and customer satisfaction.</p>
            <p>Founded in 2020, YourShop has come a long way from its beginnings. When we first started, our passion for affordable and high-quality tech drove us to start our own business.</p>
        </div>

        <!-- Why Choose Us -->
        <div class="about-section">
            <h4>Why Choose Us?</h4>
            <ul>
                <li>High-quality products at unbeatable prices.</li>
                <li>Fast and reliable customer support.</li>
                <li>Secure payment methods and hassle-free returns.</li>
                <li>Worldwide shipping with on-time delivery.</li>
            </ul>
        </div>

        <!-- Testimonials Section -->
        <div class="about-section">
            <h4>What Our Customers Say</h4>
            
            <div class="testimonial">
                <p>"Absolutely amazing products! The quality is great, and the delivery was fast. Highly recommended!"</p>
                <strong>- Emily R.</strong>
            </div>

            <div class="testimonial">
                <p>"YourShop has the best prices and fantastic customer support. I will definitely shop again!"</p>
                <strong>- Michael S.</strong>
            </div>

            <div class="testimonial">
                <p>"I love how easy it is to order, and the products are exactly as described. 5 stars!"</p>
                <strong>- Sarah W.</strong>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

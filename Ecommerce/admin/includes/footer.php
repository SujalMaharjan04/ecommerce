</div> <!-- Closing tag for content wrapper (from header.php) -->

<footer class="footer bg-dark text-light text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Techommerce Admin Panel. All Rights Reserved.</p>
    </div>
</footer>

<!-- Bootstrap & jQuery (Required for certain features) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sticky Footer CSS -->
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

</body>
</html>

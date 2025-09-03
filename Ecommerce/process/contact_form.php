<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Send email (replace with your email)
    $to = "support@yourshop.com";
    $subject = "New Contact Message from $name";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/html";
    $body = "<h4>Name: $name</h4><p>Email: $email</p><p>Message:</p><p>$message</p>";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Message sent successfully!'); window.location='../contact.php';</script>";
    } else {
        echo "<script>alert('Error sending message. Please try again later.'); window.location='../contact.php';</script>";
    }
}
?>

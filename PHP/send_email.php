<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);

    $to = "earlrondina009@gmail.com";
    $subject = "New Message from Contact Form";
    $message = "Name: $name\nEmail: $email\n\nMessage:\n$comment";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        // Redirect to a thank-you page after successful submission
        header("Location: thank_you.html");
        exit();
    } else {
        // Redirect to an error page if email sending fails
        header("Location: error.html");
        exit();
    }
} else {
    // Redirect to the form if accessed without POST request
    header("Location: form.html");
    exit();
}
?>
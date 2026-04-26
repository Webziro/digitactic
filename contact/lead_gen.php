<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sanitize($data)
{
    return htmlspecialchars(trim($data ?? ''));
}

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = sanitize($_POST["Email"] ?? '');

    // Validation rules
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'reply.digitactic@gmail.com';     // SMTP username
            $mail->Password = 'dcatlckzhhtbhzdx';        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            // Keep the connection open for multiple emails
            $mail->SMTPKeepAlive = true;

            // 1. Send Notification to Admin
            $mail->setFrom('reply.digitactic@gmail.com', 'Digitactic Lead Gen');
            $mail->addAddress('reply.digitactic@gmail.com', 'Digitactic Admin');     
            $mail->addReplyTo($email, "New Lead");

            $mail->isHTML(false);
            $mail->Subject = 'New Lead Captured - Digitactic';
            $mail->Body = "You have received a new lead from the website popup.\n\n" .
                          "Email: $email\n";

            $mail->send();

            // 2. Send Auto-Responder to User
            $mail->clearAddresses();
            $mail->clearReplyTos();
            $mail->addAddress($email);
            // Re-set the From address for the auto-responder just in case
            $mail->setFrom('reply.digitactic@gmail.com', 'Digitactic');

            $mail->Subject = 'Thank you for your interest in Digitactic';
            $mail->Body = "Hi there,\n\n" .
                          "Thank you for showing interest in our services! We have received your email and one of our experts will get back to you shortly.\n\n" .
                          "In the meantime, feel free to explore our website to see some of our featured projects.\n\n" .
                          "Best regards,\n" .
                          "The Digitactic Team";

            $mail->send();
            
            // Close connection
            $mail->smtpClose();
            
            $success = true;
        } catch (Exception $e) {
            $errors[] = "Sorry, there was an error processing your request. Please try again later.";
        }
    }
} else {
    $errors[] = "Invalid request method.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'success' => $success,
    'errors' => $errors
]);
?>






<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Robust contact form handler with validation and clear messages
function sanitize($data)
{
    return htmlspecialchars(trim($data ?? ''));
}

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = sanitize($_POST["First_Name"] ?? '');
    $last_name = sanitize($_POST["Last_Name"] ?? '');
    $email = sanitize($_POST["Email"] ?? '');
    $phone = sanitize($_POST["Phone"] ?? '');
    $message = sanitize($_POST["Message"] ?? '');

    // Validation rules
    if (empty($first_name)) {
        $errors[] = "First Name is required.";
    }
    if (empty($last_name)) {
        $errors[] = "Last Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (!empty($phone) && !preg_match('/^[0-9\-\+\s\(\)]+$/', $phone)) {
        $errors[] = "Invalid phone number.";
    }
    if (empty($message)) {
        $errors[] = "Message is required.";
    } elseif (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters.";
    } elseif (strlen($message) > 1000) {
        $errors[] = "Message must be less than 1000 characters.";
    }

    if (empty($errors)) {
        $body = "You have received a new message from your website contact form.\n\n" .
            "First Name: $first_name\n" .
            "Last Name: $last_name\n" .
            "Email: $email\n" .
            "Phone: $phone\n" .
            "Message:\n$message\n";

        $mail = new PHPMailer(true);

        try {
            // Server settings (Update these with your real SMTP server details)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // e.g. smtp.gmail.com
            $mail->SMTPAuth = true;
            $mail->Username = 'reply.digitactic@gmail.com';     // SMTP username
            $mail->Password = 'dcatlckzhhtbhzdx';        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('reply.digitactic@gmail.com', 'Digitactic');
            $mail->addAddress('reply.digitactic@gmail.com', 'Digitactic Admin');     // Add a recipient
            $mail->addReplyTo($email, "$first_name $last_name");

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body = $body;

            $mail->send();
            $success = true;
        } catch (Exception $e) {
            $errors[] = "Sorry, there was an error sending your message. Mailer Error: {$mail->ErrorInfo}";
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




















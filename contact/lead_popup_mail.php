<?php
// lead_popup_mail.php
// Store email and send thank you message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    if (!$email) {
        http_response_code(400);
        exit('Invalid email');
    }

    // Store email in a file (append)
    $file = __DIR__ . '/lead_emails.txt';
    file_put_contents($file, $email . "\n", FILE_APPEND | LOCK_EX);

    // Send thank you email
    $subject = 'Thank you for your interest!';
    $message = "Hi,\n\nThank you for showing interest in our services. We appreciate your time and will get back to you soon!\n\nBest regards,\nDigitactic Team";
    $headers = 'From: noreply@digitactic.com' . "\r\n" .
               'Reply-To: noreply@digitactic.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    @mail($email, $subject, $message, $headers);

    echo 'OK';
    exit;
}
http_response_code(400);
echo 'Error';


















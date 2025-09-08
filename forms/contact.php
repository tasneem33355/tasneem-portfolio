<?php
// استبدلي ده بإيميلك اللي عايزة تستقبلي عليه الرسائل
$receiving_email_address = "tasneem33355@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name    = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : 'New Contact Form Message';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if ($name && $email && $message) {
        $headers  = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $mail_body = "You have received a new message from your website contact form:\n\n";
        $mail_body .= "Name: $name\n";
        $mail_body .= "Email: $email\n";
        $mail_body .= "Subject: $subject\n";
        $mail_body .= "Message:\n$message\n";

        if (mail($receiving_email_address, $subject, $mail_body, $headers)) {
            echo "OK"; // عشان الجافاسكريبت يعرف انه نجح
        } else {
            echo "Email sending failed!";
        }
    } else {
        echo "Please complete all required fields.";
    }
} else {
    echo "Invalid request method.";
}
?>

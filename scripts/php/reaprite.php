<?php

// Getting Post value
$data = @json_decode(file_get_contents('php://input'));
// var_dump($data);
$email = $data->email;
$message = $data->message;
$subject = $data->subject;
require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();

if ($email) {
    try {
        $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'agrorite.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->SMTPSecure = 'tls';
        $mail->Username = 'test@agrorite.com';                     // SMTP username
            $mail->Password = ')[eD1mAhR(8V';                              // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('support@reaprite.com', 'Reaprite');   // Add a recipient
            $mail->addAddress($email);               // Name is optional
            $mail->addReplyTo('support@reaprite.com', 'Tech Support');

        // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        echo 'succes';
    } catch (Exception $e) {
        echo 'error';
    }
}

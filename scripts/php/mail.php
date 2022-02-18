<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
    require "phpmailer/PHPMailerAutoload.php";
    // $mail = new PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'agrorite.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'hello@agrorite.com';                     // SMTP username
    $mail->Password   = 'j.TuY;T3ewdM';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('hello@agrorite.com', 'Agrorite');
    $mail->addAddress($userEmail, $userFirstName);     // Name is optional
    $mail->addReplyTo('hello@agrorite.com', 'Agrorite');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Agrorite Details for making payment';
    $mail->Body    = $text;

    $mail->send();
    return helper::Output_Success(["success"=>"Please check your email for our payment details"]);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return helper::Output_Error(null, $mail->ErrorInfo);
}
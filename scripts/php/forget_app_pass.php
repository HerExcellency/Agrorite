<?php
require_once 'functions.php';
require_once 'helpers/helper.php';
require "phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
// Getting Post value
$email= $_POST["email"]; 
$baseUrl = 'https://agrorite.com';
// Calling function

// array for JSON response
$androidResponse = array();

function RANDOM_STRING($length){
    $str_result = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($str_result), 0, $length);
}

$resetcode = RANDOM_STRING(50);

$fetch = fetchUser($email);
//if(array_key_exists('error',  $fetch)){
//    return helper::Output_Error(null, "Oops there has been a problem, please //try again");
//}

$userFirstName = $fetch[0]->fname;

$resetPassword = resetPassword($email, $resetcode);

if(count($fetch) === 0){
    $androidResponse["message"] = 'This email address does not exist in our database';
        // echo JSON response
        echo json_encode($androidResponse);
}else{
    
    if($resetPassword === TRUE){
        try {
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'agrorite.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->SMTPSecure = 'tls';
            $mail->Username   = 'hello@agrorite.com';                     // SMTP username
            $mail->Password   = 'j.TuY;T3ewdM';                              // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('support@agrorite.com', 'Agrorite');   // Add a recipient
            $mail->addAddress($email, $userFirstName);               // Name is optional
            $mail->addReplyTo('support@agrorite.com', 'Tech Support');
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Forgot Password Recovery';
            $mail->Body    = "<div> Dear " . $userFirstName . ", <br><p>Click the link below to recover your password. </p><br><p style='margin-top:20px'><a href='" . $baseUrl . "/reset-my-password/" . $resetcode . "'> Password Recovery </a><br></p> <br><p>Disregard this mail if you didn't initiate this process</p><br> Regards,<br> Agrorite Team.</div>";
        
            $mail->send();
            $androidResponse["message"] = 'Please check your email for intructions on how to reset your password';
            // echo JSON response
            echo json_encode($androidResponse);
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $androidResponse["message"] = 'Network error, please try again later';
            // echo JSON response
            echo json_encode($androidResponse);
        }
    
    }else{
        $androidResponse["message"] = 'Network error, try again later';
            // echo JSON response
            echo json_encode($androidResponse);
    }
}




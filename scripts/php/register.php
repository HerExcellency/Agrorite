<?php

require_once 'functions.php';
require_once 'helpers/helper.php';
$baseUrl = 'https://agrorite.com';
require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();

// Getting Post value

$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$userNationality = isset($_POST['userNationality']) ? $_POST['userNationality'] : null;
$userResidence = isset($_POST['userResidence']) ? $_POST['userResidence'] : null;
/*
 * VALIDATION FOR FIRSTNAME STARTS HERE
 */
if (empty($firstname)) {
    return helper::Output_Error(null, 'First Name is required');
}
if ($firstname === '') {
    return helper::Output_Error(null, 'Firstname field cannot be empty');
}
if (strlen($firstname) < 2) {
    return helper::Output_Error(null, 'Please put in a valid firstname');
}
if (!preg_match("/^[a-zA-Z'-]/", $firstname)) {
    return helper::Output_Error(null, 'Firstname can only contain Alphabet and Numbers');
}
/*
 * VALIDATION FOR LASTNAME STARTS HERE
 */
if (empty($lastname)) {
    return helper::Output_Error(null, 'Last Name is required');
}
if ($lastname === '') {
    return helper::Output_Error(null, 'Lastname field cannot be empty');
}
if (strlen($lastname) < 2) {
    return helper::Output_Error(null, 'Please put in a valid lastname');
}
if (!preg_match("/^[a-zA-Z'-]/", $lastname)) {
    return helper::Output_Error(null, 'Lastname can only contain Alphabet and Numbers');
}
/*
 * VALIDATION FOR EMAIL STARTS HERE
 */
if (empty($email)) {
    return helper::Output_Error(null, 'Email is required');
}
if ($email === '') {
    return helper::Output_Error(null, 'Email field cannot be empty');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return helper::Output_Error(null, 'Please put in a valid email');
}
/*
 * VALIDATION FOR PHONE STARTS HERE
 */
if (empty($phone)) {
    return helper::Output_Error(null, 'Phone Number is required');
}
if ($phone === '') {
    return helper::Output_Error(null, 'Phone number field cannot be empty');
}
if (strlen($phone) < 6 || strlen($phone) > 16) {
    return helper::Output_Error(null, 'Please put in a valid mobile number');
}
if (!preg_match('/^[0-9]/', $phone)) {
    return helper::Output_Error(null, 'Please mobile field can only be number');
}

/*
 * VALIDATION FOR COUNTRY OF ORIGIN STARTS HERE
 */
if (empty($userNationality)) {
    return helper::Output_Error(null, 'userNationality is required');
}
if ($userNationality === '') {
    return helper::Output_Error(null, 'userNationality field cannot be empty');
}
if (strlen($userNationality) < 2) {
    return helper::Output_Error(null, 'Please put in a valid userNationality');
}

/*
 * VALIDATION FOR USER COUNTRY OF RESIDENCE STARTS HERE
 */
if (empty($userResidence)) {
    return helper::Output_Error(null, "$userResidence is required");
}
if ($userResidence === '') {
    return helper::Output_Error(null, "$userResidence field cannot be empty");
}
if (strlen($userResidence) < 2) {
    return helper::Output_Error(null, "Please put in a valid u$userResidence");
}

/*
 * VALIDATION FOR PASSWORD STARTS HERE
 */
if (empty($password)) {
    return helper::Output_Error(null, 'Password is required');
}
if ($password === '') {
    return helper::Output_Error(null, 'Password field cannot be empty');
}
if (strlen($password) < 6) {
    return helper::Output_Error(null, 'Password is not strong enough');
}

/**
 * CHECK IF A USER EXIST WITH THE EMAIL ADDRESS.
 */
$fetch = fetchUserReg($email);
// database error
if (array_key_exists('error', $fetch)) {
    return helper::Output_Error(null, 'Opps there was an error performing this task please try again later');
}
if (count($fetch) > 0) {
    return helper::Output_Error(null, 'User already exist or account has not been verified, please check your email');
}
/**
 * SALTING THE PASSWORD INPUTED.
 */
$password_hash = password_hash($password, PASSWORD_BCRYPT);
function RANDOM_STRING($length)
{
    $str_result = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    return substr(str_shuffle($str_result), 0, $length);
}
$verifycode = RANDOM_STRING(50);
$date_created = date('d-m-Y');
$time_created = date('h:i:s A');

$register = registerAgroriter($firstname, $lastname, $email, $phone, $userNationality, $userResidence, $password_hash, $verifycode, $date_created, $time_created);
if ($register === true) {
    try {
        $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'agrorite.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';
        $mail->Username = 'hello@agrorite.com';                     // SMTP username
    $mail->Password = 'j.TuY;T3ewdM';                               // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('hello@agrorite.com', 'Agrorite');   // Add a recipient
    $mail->addAddress($email, $firstname);               // Name is optional
    $mail->addReplyTo('hello@agrorite.com', 'Customer Experience');

        // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email Verification From Agrorite';
        $mail->Body = '<!doctype html>
    <html>
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width" />
        
        <title>Agrorite Limited</title>
        <style>
          /* -------------------------------------
              GLOBAL RESETS
          ------------------------------------- */
          
          /*All the styling goes here*/
          
          img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%; 
          }
    
          body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%; 
          }
    
          table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%; }
            table td {
              font-family: sans-serif;
              font-size: 14px;
              vertical-align: top; 
          }
    
          /* -------------------------------------
              BODY & CONTAINER
          ------------------------------------- */
    
          .body {
            background-color: #f6f6f6;
            width: 100%; 
          }
    
          /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
          .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 580px;
            padding: 10px;
            width: 580px; 
          }
    
          /* This should also be a block element, so that it will fill 100% of the .container */
          .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px; 
          }
    
          /* -------------------------------------
              HEADER, FOOTER, MAIN
          ------------------------------------- */
          .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%; 
          }
    
          .wrapper {
            box-sizing: border-box;
            padding: 20px; 
          }
    
          .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
          }
    
          .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%; 
          }
            .footer td,
            .footer p,
            .footer span,
            .footer a {
              color: #999999;
              font-size: 12px;
              text-align: center; 
          }
    
          /* -------------------------------------
              TYPOGRAPHY
          ------------------------------------- */
          h1,
          h2,
          h3,
          h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px; 
          }
    
          h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize; 
          }
    
          p,
          ul,
          ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px; 
          }
            p li,
            ul li,
            ol li {
              list-style-position: inside;
              margin-left: 5px; 
          }
    
          a {
            color: #07c507;
            text-decoration: underline; 
          }
    
          /* -------------------------------------
              BUTTONS
          ------------------------------------- */
          .btn {
            box-sizing: border-box;
            width: 100%; }
            .btn > tbody > tr > td {
              padding-bottom: 15px; }
            .btn table {
              width: auto; 
          }
            .btn table td {
              background-color: #ffffff;
              border-radius: 5px;
              text-align: center; 
          }
            .btn a {
              background-color: #ffffff;
              border: solid 1px #07c507;
              border-radius: 5px;
              box-sizing: border-box;
              color: #07c507;
              cursor: pointer;
              display: inline-block;
              font-size: 14px;
              font-weight: bold;
              margin: 0;
              padding: 12px 25px;
              text-decoration: none;
              text-transform: capitalize; 
          }
    
          .btn-primary table td {
            background-color: #07c507; 
          }
    
          .btn-primary a {
            background-color: #07c507;
            border-color: #07c507;
            color: #ffffff; 
          }
    
          /* -------------------------------------
              OTHER STYLES THAT MIGHT BE USEFUL
          ------------------------------------- */
          .last {
            margin-bottom: 0; 
          }
    
          .first {
            margin-top: 0; 
          }
    
          .align-center {
            text-align: center; 
          }
    
          .align-right {
            text-align: right; 
          }
    
          .align-left {
            text-align: left; 
          }
    
          .clear {
            clear: both; 
          }
    
          .mt0 {
            margin-top: 0; 
          }
    
          .mb0 {
            margin-bottom: 0; 
          }
    
          .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0; 
          }
    
          .powered-by a {
            text-decoration: none; 
          }
    
          hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0; 
          }
    
          /* -------------------------------------
              RESPONSIVE AND MOBILE FRIENDLY STYLES
          ------------------------------------- */
          @media only screen and (max-width: 620px) {
            table[class=body] h1 {
              font-size: 28px !important;
              margin-bottom: 10px !important; 
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
              font-size: 16px !important; 
            }
            table[class=body] .wrapper,
            table[class=body] .article {
              padding: 10px !important; 
            }
            table[class=body] .content {
              padding: 0 !important; 
            }
            table[class=body] .container {
              padding: 0 !important;
              width: 100% !important; 
            }
            table[class=body] .main {
              border-left-width: 0 !important;
              border-radius: 0 !important;
              border-right-width: 0 !important; 
            }
            table[class=body] .btn table {
              width: 100% !important; 
            }
            table[class=body] .btn a {
              width: 100% !important; 
            }
            table[class=body] .img-responsive {
              height: auto !important;
              max-width: 100% !important;
              width: auto !important; 
            }
          }
    
          /* -------------------------------------
              PRESERVE THESE STYLES IN THE HEAD
          ------------------------------------- */
          @media all {
            .ExternalClass {
              width: 100%; 
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
              line-height: 100%; 
            }
            .apple-link a {
              color: inherit !important;
              font-family: inherit !important;
              font-size: inherit !important;
              font-weight: inherit !important;
              line-height: inherit !important;
              text-decoration: none !important; 
            }
            #MessageViewBody a {
              color: inherit;
              text-decoration: none;
              font-size: inherit;
              font-family: inherit;
              font-weight: inherit;
              line-height: inherit;
            }
            .btn-primary table td:hover {
              background-color: #34495e !important; 
            }
            .btn-primary a:hover {
              background-color: #34495e !important;
              border-color: #34495e !important; 
            } 
          }
    
        </style>
      </head>
      <body class="">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td>&nbsp;</td>
            <td class="container">
              <div class="content">
    
                <!-- START CENTERED WHITE CONTAINER -->
                <table role="presentation" class="main">
    
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <img style="margin-bottom: 20px;" src="https://agrorite.com/img/agrorite.png" alt="">
                            <p>Hello '.$firstname.',</p>
                            <p>Welcome, Thank you for joining agrorite and becoming a digital farmer</p>
                            <p style="margin-bottom: 30px;">
                                Before you get started, please confirm you email address to improve security and also to be able to access farm investments.
                            </p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                              <tbody>
                                <tr>
                                  <td align="left">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                      <tbody>
                                        <tr>
                                          <td> <a href="https://www.agrorite.com/verify/'.$verifycode.'" target="_blank">VERIFY EMAIL</a> </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <p style="margin-bottom: 20px; margin-top:30px">OR</p>
                            <p>Copy the link below and paste in your web browser</p>
                            <p><a style="color:#07c507; text-decoration: none;" href="https://www.agrorite.com/verify/'.$verifycode.'">https://www.agrorite.com/verify/'.$verifycode.'</a></p>
                            <p>If you did not sign up on The Agrorite website, please ignore this email.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
    
                <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- END CENTERED WHITE CONTAINER -->
    
                <!-- START FOOTER -->
                <div class="footer">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="content-block">
                        <span class="apple-link">If you have any inquires or questions visit our <a href="https://www.agrorite.com/faq">FAQ</a> page or contact us below</span>
                      </td>
                    </tr>
                    <tr>
                        <td class="content-block">
                          <span class="apple-link">Send mail to <a href="mailto:hello@agrorite.com">hello@agrorite.com</a><br> Or call us +234-803-542-9041</span>
                        </td>
                      </tr>
                    <tr>
                      <td class="content-block powered-by">
                        1B Olabanji Olajide Crescent, Off Mobolaji Johnson Estate,</br>
                        Lekki Phase 1, Lagos.
                      </td>
                    </tr>
                  </table>
                </div>
                <!-- END FOOTER -->
    
              </div>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </body>
    </html>';

        $mail->send();

        return helper::Output_Success(['success' => 'Please check your email for your verification code']);
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return helper::Output_Error(null, 'Oops there was an error processing your request please try again');
    }
} else {
    return helper::Output_Error(null, 'Oops there was an error please try again');
}

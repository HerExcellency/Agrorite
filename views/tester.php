<?php
$title = "Place an order || Agrorite Limited";
require_once "header.php";
?>
<?php

if($_POST["submit"]) {
    $recipient="ijeomaonuajurx@gmail.com";
    $subject="Form to email message";
    $sender=$_POST["sender"];
    $senderEmail=$_POST["senderEmail"];
    $message=$_POST["message"];

    $mailBody="Name: $sender\nEmail: $senderEmail\n\n$message";

    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

    $thankYou="<p>Thank you! Your message has been sent.</p>";
}

?>
<!DOCTYPE html>

<html>
<!-- <head>
    <meta charset="utf-8">
    <title>Contact form to email</title>
</head> -->
<div class="header-space"></div>
  <!-- Header End -->
  <!-- Breadcrumb Area Start -->
  <nav class="breadcrumb-area bg-dark bg-6 ptb-20 n40">
    <div class="container d-md-flex">
      <h2 class="text-white mb-0">Make A Request</h2>
      <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
        <li class="breadcrumb-item"><a class="text-white" href="index">Home</a> <span class="text-white">/</span></li>
        <li aria-current="page" class="breadcrumb-item active text-white">Buy from us</li>
      </ol>
    </div>
  </nav>

<body>

    <?=$thankYou ?>

    <form method="post" action="tester.php">
        <label>Name:</label>
        <input name="sender">

        <label>Email address:</label>
        <input name="senderEmail">

        <label>Message:</label>
        <textarea rows="5" cols="20" name="message"></textarea>

        <input type="submit" name="submit">
    </form>

</body>

</html>
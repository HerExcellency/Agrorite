<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");
// $urlLink = 'http://10.5.50.13/onlineagro';
// $urlLink = 'http://192.168.100.19/onlineagro';
// $urlLink = 'http://192.168.100.64/onlineagro';
// $urlLink = 'http://localhost/onlineagro';
// $urlLink = "http://5666e9a28733.ngrok.io/onlineagro";
$urlLink = "https://agrorite.com";
@session_start();
$email = @$_SESSION['email'];
@$logged = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="title" content="Agrorite - Promoting Agriculture Prosperity"/>
  <meta name="description" content="Agrorite is a technology driven platform that enables small holder farmers with finance, advisory services and premium markets."/>

  <title><?php echo $title; ?></title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlLink; ?>/assets/img/favicon.png">
  <!-- Style CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- image gallery -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="let-it-snow.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/timeline.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/photo.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/newPage.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/style.css">
  <!-- <link rel="stylesheet" href="<?php echo $urlLink; ?>/styles.css"> -->
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/owl.carousel.min.css">
  
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/slider.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/odometer.min.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/magnific-popup.min.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/faq-style.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/anniversary.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/testimony.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/team-style.css">
  <script src="<?php echo $urlLink; ?>/assets/js/vandor/jquery-3.2.1.min.js"></script>
  <!-- Modernizer JS -->
  <script src="<?php echo $urlLink; ?>/assets/js/vandor/modernizr-3.5.0.min.js"></script>
</head>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<body >
  <!-- Preloader Start -->
  <!-- <div id="fadeout" class="loader w-100 h-100 position-absolute">
    <div class="h-100 d-flex justify-content-center align-items-center">
      <div class="one circle"></div>
      <div class="two circle"></div>
    </div>
  </div> -->
  <!-- Preloader End -->

  <!-- Header Start -->
  <!-- Start Navbar Area -->
  
  
  <div class="clearfix"></div>
  
  <header class="position-fixed w-100" style="position:fixed;">
    
    <nav id="active-sticky" class="navbar navbar-light navbar-expand-lg" style="background:#fff">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $urlLink; ?>/index" >
        <!-- <img src="<?php echo $urlLink; ?>/assets/img/agroriteSharp.png" alt="Agrorite logo"> -->
        <video  autoplay muted loop  style="max-width: 77%">
            <source src="//res.cloudinary.com/ijeomaonuaju/video/upload/v1671466309/party_iwm2hb.mp4" type="video/mp4">
            <source src="//res.cloudinary.com/ijeomaonuaju/video/upload/v1671466309/party_iwm2hb.mp4" type="video/ogg">
            Your browser does not support HTML video.
          </video>
      </a>
        <button class="navbar-toggler navber-toggler-right" data-toggle="collapse" data-target="#navbarToggler">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >About Us</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo $urlLink; ?>/about-us">About Us</a></li>
                <li><a class="dropdown-item" href="<?php echo $urlLink; ?>/awards">Multimedia</a></li>
                <li><a class="dropdown-item" href="<?php echo $urlLink; ?>/team">The Team</a></li>
                <li><a class="dropdown-item" href="<?php echo $urlLink; ?>/resource">Resources</a></li>
                <li><a class="dropdown-item" href="<?php echo $urlLink; ?>/our-procedure">Our Procedure</a></li>
                <li><a class="dropdown-item" href="<?php echo $urlLink; ?>/career">Career</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo $urlLink; ?>/impact-agenda" class="nav-link">Impact Agenda</a>
            </li>
            <?php if (@$logged) {
              echo '
                </ul>
                <div class="pl-20">
                  <a class="btn btn-sm btn-primary" href="'.$urlLink.'/dashboard/open-farm">Our Farms</a>
                </div>';
                  } else {
              echo '
              <li class="nav-item">
                <a href="contact" class="nav-link">Contact</a>
              </li>
              </ul>
                ';
              }
            ?>
          <div class="pl-20">
            <a class="btn btn-sm btn-outline-light" target="_blank" href="//pastarepublic.ng/">Visit Foodies</a>
          </div>
        </div>
      </div>
    </nav>

  
    
        </div>
      </div>
    </div> 
  <div class="header-space"></div>
  </header>
  <!-- Header End -->
  
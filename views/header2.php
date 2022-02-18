<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");
// $urlLink = 'http://10.5.50.13/onlineagro';
$urlLink = 'http://192.168.100.19/onlineagro';
// $urlLink = 'http://192.168.100.64/onlineagro';
// $urlLink = 'http://localhost/onlineagro';
// $urlLink = "http://5666e9a28733.ngrok.io/onlineagro";
// $urlLink = "https://agrorite.com";
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
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/timeline.css">
  <link rel="stylesheet" href="<?php echo $urlLink; ?>/assets/css/photo.css">
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

<body>
  <!-- Preloader Start -->
  <!-- <div id="fadeout" class="loader w-100 h-100 position-absolute">
    <div class="h-100 d-flex justify-content-center align-items-center">
      <div class="one circle"></div>
      <div class="two circle"></div>
    </div>
  </div> -->
  <!-- Preloader End -->

  <!-- Header Start -->
 
<section class="spacer"></section>


<!--

-- ORIGINAL EFFECT LINKS --
https://locomotive.ca/fr
https://suturacreative.com
https://cuberto.com

-->


  <div class="clearfix"></div>
  <header class="position-fixed w-100" style="position:fixed;">
  <div class="marquee-header-area" style="border-bottom:1px solid #eeeeee" >
      <div class="container-fluid">
          <div class="row"> 
            <div class="liveDataTitle">
              <h5 class="marqTitle">Live Data</h5>
            </div>
            <div class="marquee3k tradeProducts align-items-center" data-speed="0.25" data-pausable="bool">
                <a href="//app.reaprite.com/savings/reapgoal/village/80" target="_blank">
                <p class="tradeP">
                  <span style=" color: #eeeeee, padding-left: 3px; padding-right: 3px; margin-right: 5px">    Cocoa <b> $1,851 </b><i class="tradeProfit"> 2.8% </i></span>
                 <span style=" margin-left:5px;color: #eeeeee, padding-left: 3px; padding-right: 3px"> Paddy Rice Aggregation Note-Ethical<b> $5000 </b><i class="tradeLoss"> 00% </i></span>
                 <span style=" margin-left:5px;color: #eeeeee, padding-left: 3px; padding-right: 3px"> Sorghum <b> #2400 </b><i class="tradeProfit"> 18% </i></span>
                 <span style=" margin-left:5px;color: #eeeeee, padding-left: 3px; padding-right: 3px"> Soyabean <b> #4000 </b><i class="tradeLoss"> 12% </i></span>
                 <span style=" margin-left:5px;color: #eeeeee, padding-left: 3px; padding-right: 3px"> Raw Cashew nuts <b> #593.115 </b><i class="tradeLoss"> 6.7% </i></span>
                 <span style=" margin-left:5px;color: #eeeeee, padding-left: 3px; padding-right: 3px"> Paddy rice Long Grain <b> #222.140 </b><i class="tradeProfit"> 9.5% </i></span>
                 <span style=" margin-left:5px;color: #eeeeee, padding-left: 3px; padding-right: 3px"> Maize <b> #400 </b><i class="tradeLoss"> 2.8% </i></span>
                </p>
              </a>                   
            </div>
          </div>
      </div>
    </div>

</section>
    <!-- <div class="show bg-3" style="color:#fff; font-size:12px; margin-bottom:0px;">
      <div class="container" >
        <div class="row mCenter">
          <div class="col-lg-9 col-md-8 col-sm-7 col-12 mysize" style="color:#000;">
            <h5>Africa's #1 Digital Agricultural Brand</h5>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-5 col-12 myTop mysize">
            <h5><a style="color:#000;" href="tel:+2348035429041" >Hotline: +234 803 542 9041</a></h5>
          </div>
        </div>
      </div>
    </div> -->
    <nav id="active-sticky" class="navbar navbar-light navbar-expand-lg" style="background:#fff">
      <div class="container">
        <a class="navbar-brand" href="<?php echo $urlLink; ?>/index"><img src="<?php echo $urlLink; ?>/assets/img/agrorite.webp" alt="Agrorite logo"></a>
        <button class="navbar-toggler navber-toggler-right" data-toggle="collapse" data-target="#navbarToggler">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav ml-auto mx-auto">
           <!-- <li class="nav-item">
              <a href="<?php echo $urlLink; ?>/home" class="nav-link">Home</a>
            </li> -->
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
            <a class="f-icon fa fa-phone" href="tel:+2348032779222"><i></i></a>
            <a class="btn btn-sm btn-outline-light" target="_blank" href="https://foodies.ng">Visit Foodies</a>
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
  
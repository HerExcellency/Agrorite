<?php
  $title = 'Agrorite: Nigerian Digital Agriculture Platform';
  require_once 'views/header.php';
  require_once 'scripts/php/functions.php';
  //select all farms available
  $allFarmsLimit = fetchAllFarmsLimit();
  ?>

<section class=" container-fluid" style="height: auto;">
    <div class="" style=" width: 84%; height: 80vh; margin: auto;">
        <div class="landingBen h-100 h-sm-auto d-flex flex-row align-items-center flex-wrap flex-md-nowrap" style="padding-top: 140px">
            <div class=" row col-lg-4 col-md-4 col-sm-12">
            <div class="caption captionText ">
                <h3 class="display-1 mb-10 mt-25 captyH" style="color: #07c507; text-align: center">Agribusiness <br>Made Easy</h3>
                <p class="mb-20 captyP " style="line-height:1.5"><b>Agrorite</b> is making Agribusiness profitable by ensuring <b>local and international fair trade</b> of agro commodities.</p>    
                <img src="assets\img\newIndex\shittuNoBG.png" alt="">
                </div> 
                <img class="landingMobileImage caption col-lg-8 col-md-6 col-sm-12" src="assets/img/newIndex/shittuHeroPage.png" alt="">
        
            </div>
        </div>
    </div>
</section>
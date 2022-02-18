<?php

$title = 'Investments || Agrorite Limited';

require_once 'header.php';

require_once 'scripts/php/functions.php';

//select all farms available

$allFarmsLimit = fetchAllFarmsInvestment();

?>

  <div class="header-space"></div>

  <!-- Header End -->

  <!-- Breadcrumb Area Start -->

  <nav class="breadcrumb-area bg-dark bg-6 ptb-20 n40">

    <div class="container d-md-flex">

      <h2 class="text-white mb-0">Our Farms</h2>

      <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">

        <li class="breadcrumb-item"><a class="text-white" href="index">Home</a> <span class="text-white">/</span></li>

        <li aria-current="page" class="breadcrumb-item active text-white">Our Farms</li>

      </ol>

    </div>

  </nav>

  <!-- Breadcrumb Area End -->

  <!-- Featured Section Start -->

  <section class="section-ptb bg-1">

    <div class="container">

      <div class="row text-center">

        <div class="col-12">

          

        </div>

      </div>

      <div class="row text-center">

      <?php

      $numRow = mysqli_num_rows($allFarmsLimit);

      if ($numRow === 0) {
          echo 'No farm available';
      } else {
          while ($row = mysqli_fetch_assoc($allFarmsLimit)) {
              $farmId = $row['id'];
              $farmCycle = $row['cycle'];
              if ($farmCycle === 'pending') {
                  $getFarmStatus = getFarmStatus($farmId);
                  if (count($getFarmStatus) > 0) {
                      $farmStatus1 = $getFarmStatus[0]->status;
                  } else {
                      $farmStatus1 = 'coming soon';
                  }
              } else {
                  $farmStatus1 = 'completed';
              }
              $farmImg = $row['picture'];

              $farmName = $row['title'];

              $farmSlug = $row['id_name'];

              $farmUnit = $row['units'];

              $farmStatus = $row['status'];

              if ($farmStatus === 'so') {
                  $myColor = 'border-top: 5px solid #c82333; border-radius: 10px;';
                  $farmUrl = '<a class="btn-danger text-center" style="color:#fff; border-radius:10px; font-size:1.2rem"">Farm Update: '.$farmStatus1.'</a>';
                  $status = '<p class="text-left" style="margin-left:10px; color:green; font-size:1.2rem">Update: '.$farmStatus1.'</p>';
                  $unitleft = '';
              } elseif ($farmStatus === 'os') {
                  $myColor = 'border-top: 5px solid #fec96b; border-radius: 10px;';
                  $farmUrl = '<a class="btn-warning text-center" style="border-radius:10px">Opening Soon</a>';
                  $status = '';
                  $unitleft = '';
              } else {
                  $myColor = 'border-top: 5px solid #07c507; border-radius: 10px;';
                  $farmUrl = '<a href="'.$urlLink.'/dashboard/farms/'.$farmSlug.'" style="border-radius:10px" class="btn-primary text-center">Now Selling</a>';
                  $status = '';
                  $unitleft = '<p class="text-left" style="margin-left:10px">Units left: '.$farmUnit.'</p>';
              }

              echo '

              <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-sm-30 mb-md-30 mb-20">

                <div class="card card1 featured-item" style="'.$myColor.'">

                  <div class="card-body card-body1">

                    <a class="item-link">

                      <img style="border-radius:3px" src="assets/img/product/'.$farmImg.'">

                    </a>

                    '.$unitleft.'
                  </div>

                  '.$farmUrl.'

                </div>

              </div>                                      

              ';
          }
      }

  ?>

        <!-- Single Featured End -->

      </div>

      

    </div>

  </section>

  <!-- Featured Section End -->



  <?php require_once 'footer.php'; ?>








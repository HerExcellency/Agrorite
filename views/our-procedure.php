<?php

  $title = 'Our Process || Agrorite Limited';

  require_once 'header.php';

?>

  <div class="header-space"></div>

  <!-- Header End -->
  <div class="container-fluid n40" style="background-color:#F0F0F0">
    <section class="section-ptb bb-2" style="margin-top:-10px; padding-bottom:30px">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 subHead">
              <h1 class="" style=" line-height:.8">Our Procedure</h1>
              <h4 class="mb-0" style="line-height:1.8">Our time tested procedure of delivering a realistic market income revenue to the benefit of farmers and investors is second to none.</h4>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- for the farmers -->
  <div class="container-fluid parallax5">
    <section class="section-ptb bb-2 mysection3">
      <div class="row">

        <?php
            $ourProcedure = array(
                array(
                    "subPro" => "1. Contracts",
                    "pPro" => "We secure access to premium markets by sourcing profitable contracts from both local and international buyers, before the harvest period.",
                ),

                array(
                  "subPro" => "2. Harvesting and Warehousing",
                  "pPro" => "During harvest period the ripe crops are harvested from the field by the farmers and collected to a central Agrorite Aggregation Center (AGC) for easy off take.",
                 ),

                // array(
                //   "subPro" => "3. Financing",
                //   "pPro" => "Funds are pulled in from investors who contribute the capital that is used for investment in the farming circle. The capital is then put into production, trading and logistics where our on boarded smallholder farmers are engaged. The funds are also used for trading agro commodities locally and internationally",
                // ),

                array(
                  "subPro" => "3. Insurance",
                  "pPro" => "Insurance is the protection against an unforeseen natural event. Each of our farm locations and commodity on transit carries an assurance cover to protect our investor’s investment.",
                ),
                array(
                  "subPro" => "4. Trade",
                  "pPro" => "Prior to embarking on a farming project, we source and identify buyers and negotiate on profitable margins that will favor the farmers. Upon harvest, the produce is package and shipped to the off takers locally or internationally. Crops not cultivate by us are equally sourced for trading.",
                ),

                array(
                  "subPro" => "5. Food",
                  "pPro" => "We offer well processed and high quality poultry produce to direct consumer.",
                ),

                array(
                  "subPro" => "6. Agrorite Bookies",
                  "pPro" => "We provide farm inventory management system to the farmer to ensure adequate documentation of expenses associated with the farming process, and also provide bi-weekly report to investors and off-takers.",
                ),

                

            );

            foreach ($ourProcedure as $oProced) {

            ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12" >
              <div class="process-farmers subHead">
                <h1 class="color-green"><?php echo $oProced["subPro"]; ?></h1>
                <p class="mb-0"><?php echo $oProced["pPro"]; ?></p>
              </div>
           </div>

          <?php } ?>
      </div>
    </section>
  </div>
<?php require_once "footer.php";?>
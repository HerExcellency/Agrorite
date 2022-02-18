    
    <?php
    $page = 'home';
    require_once 'header.php';

    ?>
    <div id="index-page"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">
                                    <script type="text/javascript">
                                        var myDate = new Date();  
                                        if (myDate.getHours() < 12) {
                                            document.write("Good Morning, ");
                                        }
                                        else if(myDate.getHours() >=12 && myDate.getHours() <=17){
                                            document.write("Good Afternoon, ");
                                        }
                                        else if (myDate.getHours() > 17 && myDate.getHours() <=24) {
                                            document.write("Good Evening, ");
                                        }
                                        else
                                        {
                                            document.write("Good Night");
                                        }
                                    </script> <?php echo $firstName; ?>
                                </h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
									<h4 class="m-t-5 m-b-25">Sponsored</h4>
                                    <h3 class="f-w-700 col-green"><?php
                                     if ($userCount === 0) {
                                         echo "<p style='font-size:1.5rem'>You have not sponsored any farm yet</p>";
                                     } elseif ($userCount === 1) {
                                         echo '1 Farm';
                                     } else {
                                         echo $userCount.' Farms';
                                     }
                                    ?>
                                    </h3>
                                    <hr class="mt-3">
                                    <?php
                                    if ($userCount === 0) {
                                        echo '
                                        <a href="'.$dashboardUrl.'/open-farm" type="button" class="btn btn-primary waves-effect" style="padding-top:10px">Sponsor a farm</a>';
                                    } else {
                                        echo '
                                        <a href="'.$dashboardUrl.'/sponsored-farms" type="button" class="btn btn-primary waves-effect" style="padding-top:10px">My Farms</a>';
                                    }
                                    ?>
								</div>
								<div class="col-auto">
									
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
                                    <h4 class="m-t-5 m-b-20">How to sponsor a farm</h4>
									<p class="m-b-0">01. Go to open <a style="color:#07c507" href="<?php echo $dashboardUrl; ?>/open-farm">Farms</a></p>
									<p class="m-b-0">02. Click Sponsor button on an open farm</p>
									<p class="m-b-0">03. Enter number of units you want to buy</p>
                                    <p class="m-b-0">04. Pay using your preferred payment channel</p>
                                    <p class="m-b-0 mt-4"><a style="color:#07c507" href="../terms">Terms and conditions</a></p>
								</div>
								<div class="col-auto">
									<div class="chart chart-pie"></div>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
                                    <h4 class="m-t-5 m-b-20">Need Help?</h4>
									<p class="m-b-0">See our <a style="color:#07c507" href="../faq">FAQ</a> section for any questions or send us an email. </p>
									<p class="m-b-0 mt-5">Your ROI is paid at the end of your investment tenure</p>
								</div>
								<div class="col-auto">
									<div class="chart chart-pie"></div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="row">
                <?php
                if (mysqli_num_rows($pendingInvestment) > 0) {
                    echo '
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Pending Farm Payment</h4>
                            </li>
                        </ul>
                    </div>
                ';
                }
                     while ($row = mysqli_fetch_assoc($pendingInvestment)) {
                         $farmId = $row['farm_id'];
                         $farmAmount22 = number_format($row['amount'], 2);
                         $farmUnit22 = $row['farm_unit'];
                         $farmNam = fetchFarmDetailsById($farmId);
                         $myFarmName = $farmNam[0]->title;
                         echo '
                         <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-t-5 m-b-20" style="color:#07c507">'.$myFarmName.'</h6>
                                            <p class="m-b-0">Amount Paid: ₦'.$farmAmount22.'</p>
                                            <p class="m-b-0">Unit Bought: '.$farmUnit22.'</p>
                                            <p class="m-b-0">Pending approval by Agrorite</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="chart chart-pie"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         ';
                     }
                ?>
            </div>
            
            
            <div class="row">
            <?php
            if (mysqli_num_rows($countFarm2) > 0) {
                echo '
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Active Investment</h4>
                        </li>
                    </ul>
                </div>
            ';
            }
                while ($row = mysqli_fetch_assoc($countFarm2)) {
                    $farmUnitPrice = $row['price'];
                    $farmUnit = $row['unit'];
                    $farmTotalPrice1 = $row['total'];
                    $farmTotalPrice = number_format($row['total'], 2);
                    $farmStart = $row['date_started'];
                    $farmEnd = $row['date_end'];
                    $farmDuration = $row['duration'];
                    $farmPercent = $row['percentage'];
                    $farmTitle = $row['farm_title'];
                    $farmStatus = $row['status'];
                    if (intval($farmStatus) === 1) {
                        $farmPayment = 'Paid';
                    } else {
                        $farmPayment = 'Pending';
                    }
                    $percent = ($farmPercent / 100) * $farmTotalPrice1;
                    $expectedReturn1 = $farmTotalPrice1 + $percent;
                    $expectedReturn = number_format($expectedReturn1, 2);

                    /**
                     * TO CALCULATE THE PERCENTAGE FOR THE PROGRESS BAR.
                     */
                    $date1 = new DateTime($farmStart);
                    $date2 = new DateTime($farmEnd);
                    $whole_diff = $date1->diff($date2);
                    $total_days_diff = $whole_diff->days;
                    $today = date('d-m-Y');
                    $dt = new DateTime($today);
                    //differecnce between the end date and today
                    $rem_diff = $date2->diff($dt);
                    $remaining_days = $rem_diff->days;
                    $spent_days = $total_days_diff - $remaining_days;
                    $percentage_spent = ($spent_days / $total_days_diff) * 100;

                    /**
                     * TO CALCULATE THE AMOUNT THE FARM GENERATE DAILY FOR THE CUSTOMER.
                     */
                    $dailyEarning = $expectedReturn1 / $total_days_diff;
                    $daysInvested = $dt->diff($date1);
                    $total_days_invested = $daysInvested->days;
                    $currentEarning = $total_days_invested * $dailyEarning;

                    echo '
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="m-t-5 m-b-15" style="color:#07c507">Farm: '.$farmTitle.' <i class="fa fa-check"></i></h5>
                                        <p class="m-b-0">Amount Invested: <span>₦'.$farmTotalPrice.'</span></p>
                                        <p class="m-b-0">Duration: <span>'.$farmDuration.' </span>months</p>
                                        <p class="m-b-0">Percentage: <span>'.$farmPercent.'</span>%</p>
                                        <p class="m-b-0">Number of unit: <span>'.$farmUnit.'</span></p>
                                        <div class="progress" style="margin-bottom:0px">
                                        <div class="progress-bar progress-bar-info btn-primary" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: '.number_format($percentage_spent, 2).'%;">
                                        '.number_format($percentage_spent, 2).'% reached
                                        </div>
                                        </div>
                                        <p class="m-b-0 mt-2">Earnings so far: ₦'.number_format($currentEarning, 2).'</p>
                                        <p class="m-b-0 mt-2">Expected Return: <span>₦'.$expectedReturn.'</span></p>
                                    </div>
                                    <div class="col-auto">
                                        <div class="chart chart-pie"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>
            </div>
            <!-- product -->
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Recently Added Farms</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
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
                                                $farmUrl = '<div class="product-content">
                                                     <h3 class="title text-left" style="margin-bottom:23px"></h3>
                                                    <div class="text-left"><a type="button" class="btn btn-danger waves-effect w-100 text-left dashbtn">Farm Update: '.$farmStatus1.'</a></div>
                                                </div>';
                                            } elseif ($farmStatus === 'os') {
                                                $farmUrl = '<div class="product-content">
                                                    <h3 class="title text-left" style="margin-bottom:23px"></h3>
                                                    <div class="text-left"><a type="button" class="btn btn-warning waves-effect w-100" style="padding-top:10px; background-color:#fec96b">Opening Soon</a></div>
                                                </div>';
                                            } else {
                                                $farmUrl = '<div class="product-content">
                                                     <h3 class="title text-left" style="margin-left:10px">'.$farmUnit.'<span class="small"> units left</span></h3>
                                                    <div class="text-left"><a href="'.$dashboardUrl.'/farms/'.$farmSlug.'" type="button" class="btn btn-primary waves-effect w-100" style="padding-top:10px">Now Selling</a></div>
                                                </div>';
                                            }
                                            echo '
                                            <div class="col-md-3 col-sm-6 col-6">
                                                <div class="product-grid">
                                                    <div class="product-image">
                                                        <a class="image">
                                                            <img class="pic-1" src="../assets/img/product/'.$farmImg.'" alt="'.$farmName.'">
                                                        </a>
                                                    </div>
                                                    '.$farmUrl.'
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="text-center mb-5"><button onclick="window.location.href='<?php echo $dashboardUrl; ?>/all-farms'" type="button" class="btn btn-outline-primary">See All Farms</button></div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
            </div>
        </div>
    </section>

    <?php require_once 'footer.php'; ?>
<?php 
$page = 'myfarm';
require_once "header.php"; ?>

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">List of farms sponsored</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Farm Invested</th>
                                            <th>Unit Price</th>
                                            <th>Farm Duration</th>
                                            <th>% returns</th>
                                            <th>Units Bought</th>
                                            <th>Amount Paid</th>
                                            <th>Expected Return</th>
                                            <th>Farm Update</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = mysqli_fetch_assoc($countFarm)){
                                                $farmUnitPrice = $row['price'];
                                                $farmUnit = $row['unit'];
                                                $farmTotalPrice1 = $row['total'];
                                                $farmTotalPrice = number_format($row['total']);
                                                $farmStart = $row['date_started'];
                                                $farmEnd = $row['date_end'];
                                                $farmDuration = $row['duration'];
                                                $farmPercent = $row['percentage'];
                                                $farmTitle = $row['farm_title'];
                                                $farmId = $row['farm_id'];
                                                $getFarmSlug = fetchFarmDetailsById($farmId);
                                                $farmSlug = $getFarmSlug[0]->id_name;
                                                //to get the status of the farm
                                                $ThefarmStatus = $getFarmSlug[0]->status;
                                                if($ThefarmStatus === 'so'){
                                                    $getFarmStatus = getFarmStatus($farmId);
                                                    if(count($getFarmStatus) > 0){
                                                        $orl = ''.$dashboardUrl.'/farm-update/'.$farmSlug.'';
                                                        $myStatus = '<a style="color:#07C507" href="'.$orl.'">View Update</a>';
                                                    }else{
                                                        $myStatus = 'coming soon';
                                                    }
                                                }else{
                                                    $myStatus = 'coming soon';
                                                }
                                                //status of the investor if its paid or
                                                $farmStatus = $row['status'];
                                                if(intval($farmStatus) === 1){
                                                    $farmPayment = "Paid";
                                                }else{
                                                    $farmPayment = 'Pending';
                                                }
                                                $percent = ($farmPercent/100) * $farmTotalPrice1;
                                                $expectedReturn1 = $farmTotalPrice1 + $percent;
                                                $expectedReturn = number_format($expectedReturn1);
                                                echo "
                                                <tr>
                                                    <td>$farmTitle</td>
                                                    <td>₦$farmUnitPrice</td>
                                                    <td>$farmDuration Months</td>
                                                    <td>$farmPercent%</td>
                                                    <td>$farmUnit</td>
                                                    <td>₦$farmTotalPrice</td>
                                                    <td>₦$expectedReturn</td>
                                                    <td>$myStatus</td>
                                                    <td>$farmStart</td>
                                                    <td>$farmEnd</td>
                                                    <td>$farmPayment</td>
                                                </tr>
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>

<?php require_once "footer.php"; ?>




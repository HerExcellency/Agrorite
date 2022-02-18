<?php require_once "header.php"; 
$row = mysqli_fetch_assoc($farmDetails);
$farmImg = $row['picture'];
$farmUnit = $row['units'];
$farmTitle = $row['title'];
$farmPercent = $row['percentage'];
$farmDuration = $row['duration'];
$farmPrice = number_format($row['cost'], 2);
?>


<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Farm Details</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="card-body ">
                                <div class="product-store">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                            <div class="product-gallery">
                                                <div class="product-gallery-featured">
                                                    <img src="<?php echo $baseUrl; ?>/assets/img/product/<?php echo $farmImg; ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-5 mt-no">
                                            <div class="product-payment-details">
                                                <h2 class="product-title mb-2"><?php echo $farmTitle; ?> </h2>
                                                <h3 class="product-price">₦<?php echo $farmPrice; ?> <span class="small">Per Unit</span></h3>
                                                <p><strong>Rate: <?php echo $farmPercent; ?>%</strong></p>
                                                <p><strong>Duration: <?php echo $farmDuration; ?> months</strong></p>
                                                <!-- <p><strong>Insurance:</strong> <img style="width:8%" src="<?php echo $baseUrl; ?>/assets/img/client/logo/leadway.png"></p> -->
                                                <p style="font-weight:bold"><?php echo $farmUnit; ?> units available</p>
                                                <!-- <input type="number" value="1" min="1" id="quant" class="form-control mb-5 input-lg"
                                                    placeholder="Choose the quantity"> -->
                                                <button onclick="window.location.href='<?php echo $dashboardUrl; ?>/sponsor/<?php echo $slug; ?>'" type="button" class="btn btn-primary waves-effect">Sponsor Farm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php require_once "footer.php"; ?>
<?php
$page = 'allfarm';
require_once 'header.php'; ?>
<section class="content">
        <div class="container-fluid">
            <!-- product -->
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">All Farms</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="categories">
                            <ul>
                                <li>
                                    <a href="#" data-filter="*">All Farms</a>
                                </li>
                                <li>
                                    <a href="#" data-filter=".now-open">Open Farms</a>
                                </li>
                                <li>
                                    <a href="#" data-filter=".open-soon">Coming Soon Farms</a>
                                </li>
                                <li>
                                    <a href="#" data-filter=".sold-out">Closed Farms</a>
                                </li>
                            </ul>
                        </div>
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
                                $numRow = mysqli_num_rows($allFarms);
                                if ($numRow === 0) {
                                    echo 'No farm available';
                                } else {
                                    while ($row = mysqli_fetch_assoc($allFarms)) {
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
                                                    <div class="text-left"><a class="btn btn-danger waves-effect w-100 text-left dashbtn">Farm Update: '.$farmStatus1.'</a></div>
                                                </div>';
                                            $classme = 'sold-out';
                                        } elseif ($farmStatus === 'os') {
                                            $farmUrl = '<div class="product-content">
                                                    <h3 class="title text-left" style="margin-bottom:23px"></h3>
                                                    <div class="text-left"><a type="button" class="btn btn-warning waves-effect w-100" style="padding-top:10px; background-color:#fec96b">Opening Soon</a></div>
                                                </div>';
                                            $classme = 'open-soon';
                                        } else {
                                            $classme = 'now-open';
                                            $farmUrl =
                                            '<div class="product-content">
                                                 <h3 class="title text-left" style="margin-left:10px">'.$farmUnit.'<span class="small"> units left</span></h3>
                                                <div class="text-left"><a href="'.$dashboardUrl.'/farms/'.$farmSlug.'" type="button" class="btn btn-primary waves-effect w-100" style="padding-top:10px">Now Selling</a></div>
                                            </div>';
                                        }
                                        echo '
                                        <div class="col-md-3 col-sm-6 col-6 portfolio-item '.$classme.'">
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
                    </div>
                </div>
                <!-- #END# Line Chart -->
            </div>
        </div>
    </section>
<?php require_once 'footer.php'; ?>
<script src="<?php echo $baseUrl; ?>/scripts/js/filter.js"></script>
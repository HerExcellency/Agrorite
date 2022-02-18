<?php 
$page = 'openfarm';
require_once "header.php"; 
?>
<section class="content">
        <div class="container-fluid">
            <!-- product -->
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Open Farms</h4>
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
                                $numRow = mysqli_num_rows($allFarmsOpened);
                                if($numRow === 0){
                                    echo '<h4 style="padding:20px">No farm available</h4>';
                                }else{
                                    while($row = mysqli_fetch_assoc($allFarmsOpened)){
                                        $farmImg = $row['picture'];
                                        $farmName = $row['title'];
                                        $farmSlug = $row['id_name'];
                                        $farmUnit = $row['units'];
                                        echo '
                                        <div class="col-md-3 col-sm-6 col-6">
                                            <div class="product-grid">
                                                <div class="product-image">
                                                    <a class="image">
                                                        <img class="pic-1" src="../assets/img/product/'.$farmImg.'" alt="'.$farmName.'">
                                                    </a>
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="title text-left">'.$farmUnit.'<span class="small"> units left</span></h3>
                                                    <div class="text-left"><a href="'.$dashboardUrl.'/farms/'.$farmSlug.'" type="button" class="btn btn-primary m-t-15 waves-effect w-100 mb-40" style="padding-top:10px">Now Selling</a></div>
                                                </div>
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
<?php require_once "footer.php"; ?>
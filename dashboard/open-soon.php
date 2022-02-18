<?php 
$page = 'comingfarm';
require_once "header.php"; ?>
    <section class="content">
        <div class="container-fluid">
            <!-- product -->
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Opening Soon Farms</h4>
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
                                $numRow = mysqli_num_rows($allFarmsSoon);
                                if($numRow === 0){
                                    echo 'No farm available';
                                }else{
                                    while($row = mysqli_fetch_assoc($allFarmsSoon)){
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
                                                    <h3 class="title text-left"></h3>
                                                    <div class="text-left"><a type="button" class="btn btn-warning waves-effect w-100" style="padding-top:10px; background-color:#fec96b">Opening Soon</a></div>
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
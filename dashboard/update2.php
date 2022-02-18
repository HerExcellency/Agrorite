<?php 
$page = 'Farm Update';
require_once "header.php"; 
$getDetails = mysqli_fetch_assoc($farmDetails);
$farmName = $getDetails['title'];
$farmId = $getDetails['id'];

$getFarmUpdate = getAllFarmStatus($farmId);

$adminUrl = 'http://localhost/agroman/assets/images/products';

?>
 
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Updates on <?php echo $farmName; ?></h4>
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
                        <div class="card-body ">
                            <div class="product-store">
                                
                                <?php
                                    if(count($getFarmUpdate) > 0){
                                        for($g = 0; $g < count($getFarmUpdate); $g++){
                                            $updateId = $getFarmUpdate[$g]->id;
                                            $d1 = $getFarmUpdate[$g]->created;
                                            $dt = new DateTime($d1);
                                            $date = $dt->format('m-d-Y');
                                            $status = $getFarmUpdate[$g]->status;
                                            $details = $getFarmUpdate[$g]->details;
                                            $update_title = $getFarmUpdate[$g]->update_title;
                                            $farmUpateImage = getFarmStatusImage($updateId);
                                            $imageCount = count($farmUpateImage);
                                            // if($imageCount > 0){
                                            //     if($imageCount === 1){
                                            //         $myImageName = $farmUpateImage[0]->picture;
                                            //         $myImage = '
                                            //         <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                            //             <a href="'.$adminUrl.'/'.$myImageName.'" data-sub-html="'.$farmName.'">
                                            //             <img class="img-responsive thumbnail" src="'.$adminUrl.'/'.$myImageName.'" alt="">
                                            //             </a>
                                            //         </div>';
                                            //     }else{
                                            //         for($i = 0; $i < $imageCount; $i++){
                                            //             $myImageName = $farmUpateImage[$i]->picture;
                                            //         }
                                            //         $myImage = '
                                            //         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            //             <a href="'.$adminUrl.'/'.$myImageName.'" data-sub-html="'.$farmName.'">
                                            //             <img class="img-responsive thumbnail" src="'.$adminUrl.'/'.$myImageName.'" alt="">
                                            //             </a>
                                            //         </div>';
                                            //     }
                                            // }else{
                                            //     $myImage = '<p> No Image yet</p>';
                                            // }
                                            echo '
                                            <div class="row" style="border-bottom:2px solid green; margin-top:20px">
                                            <div class="col-12">
                                                <h4>'.$date.'</h4>
                                            </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">';
                                                    if($imageCount > 0){
                                                        if($imageCount === 1){
                                                            $myImageName = $farmUpateImage[0]->picture;
                                                            echo '
                                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                <a href="'.$adminUrl.'/'.$myImageName.'" data-sub-html="'.$farmName.'">
                                                                <img class="img-responsive thumbnail" src="'.$adminUrl.'/'.$myImageName.'" alt="">
                                                                </a>
                                                            </div>';
                                                        }else{
                                                            for($i = 0; $i < $imageCount; $i++){
                                                                $myImageName = $farmUpateImage[$i]->picture;
                                                                echo '
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <a href="'.$adminUrl.'/'.$myImageName.'" data-sub-html="'.$farmName.'">
                                                                    <img class="img-responsive thumbnail" src="'.$adminUrl.'/'.$myImageName.'" alt="">
                                                                    </a>
                                                                </div>';
                                                            }
                                                        }
                                                    }else{
                                                        echo '<p> No Image yet</p>';
                                                    }
                                                 echo '  </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                                    <div class="product-payment-details">
                                                        <p>Status: '.$status.'</p>
                                                        <h4 class="product-title mb-2">'.$update_title.'</h4>
                                                        <p>'.$details.'</p>
                                                    </div>
                                                </div>
                                            </div>';
                                        }

                                    }else{
                                        echo '<p> No Updates yet</p>';
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<?php require_once "footer.php"; ?>

<div class="container">
  <div class="row">
    <a href="https://unsplash.it/1200/768.jpg?image=251" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
      <img src="https://unsplash.it/600.jpg?image=251" class="img-fluid rounded">
    </a>
    <a href="https://unsplash.it/1200/768.jpg?image=252" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
      <img src="https://unsplash.it/600.jpg?image=252" class="img-fluid rounded">
    </a>
    <a href="https://unsplash.it/1200/768.jpg?image=253" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
      <img src="https://unsplash.it/600.jpg?image=253" class="img-fluid rounded">
    </a>
  </div>
</div>


07050872606,09087108339,09090267087,07033873529,07066779394,07052994264,08136490458,08162670070,08133140250,08036804033,08084492791,08092697176,08061202130,07060952318,08033995642,08034717827,09086786500,08080259452,08023634696,08082129003,07063600120,08166527139,08062905095,08038030096,08035900049,07064661777,08022665844,08057421478,07069517464,08025540582,08033085679,09037712946,08035758577,08025878065,08033795218,07061884914,08122291695,08034970499,08098038255,08033519434,08062676041,08028338439,08149575303,08160853560,09024263340,08184692181,09058424758,07050872606,07061967265,07087011328

https://glideup.dexignlab.com/demo/index-2.html
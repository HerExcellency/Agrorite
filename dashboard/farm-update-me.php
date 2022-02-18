<?php 
$page = 'Farm Update';
require_once "header.php"; 
$getDetails = mysqli_fetch_assoc($farmDetails);
$farmName = $getDetails['title'];
$farmId = $getDetails['id'];

$getFarmUpdate = getAllFarmStatus($farmId);

// $adminUrl = 'http://localhost/agroman/assets/images/products';
$adminUrl = 'https://access.agrorite.com/assets/images/products';

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
                                            
                                            echo '
                                            <div class="row" style="border-bottom:2px solid green; margin-top:20px">
                                            <div class="col-12">
                                                <h4>'.$date.'</h4>
                                            </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                                    <div class="row clearfix">';
                                                    if($imageCount > 0){
                                                        for($i = 0; $i < $imageCount; $i++){
                                                            $myImageName = $farmUpateImage[$i]->picture;
                                                            echo '
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <a href="'.$adminUrl.'/'.$myImageName.'" data-toggle="lightbox" data-gallery="gallery">
                                                                <img class="img-fluid rounded" src="'.$adminUrl.'/'.$myImageName.'" alt="">
                                                                </a>
                                                            </div>';
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
                                        echo '<p> No Updates Yet...</p>';
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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script>
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
</script>
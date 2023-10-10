<?php $title = "Our Awards || Agrorite Limited"; require_once "header.php"; ?>
    <div class="header-space"></div>
    <!-- Header End -->
    <!-- Breadcrumb Area Start -->

    <nav class="breadcrumb-area bg-dark bg-6 ptb-20 n40">
        <div class="container d-md-flex">
            <h2 class="text-white mb-0">Our Awards</h2>
            <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
                <li class="breadcrumb-item"><a class="text-white" href="index">Home</a> <span class="text-white">/</span></li>
                <li aria-current="page" class="breadcrumb-item active text-white">Our Awards</li>
            </ol>
        </div>
    </nav>

<!-- Breadcrumb Area End -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="my-ul text-center">
                    <li class="nav-item"><a href="awards" class="nav-link ">Awards</a></li>
                    <li class="nav-item"><a href="media" class="nav-link active">Media</a></li>
                    <li class="nav-item"><a href="photos" class="nav-link">Photos</a></li>
                    <li class="nav-item"><a href="videos" class="nav-link">Video</a></li>
                </ul>
            </div>
        </div>
    <section class="section-ptb1 bg-white">

        <div class="container">
            <div class="row text-center">
            <?php
            $mediaLister = array(

                array(
                    "images" => "vanguard.png",
                    "house" => "Vanguard",
                    "posting" => "Agrorite: Creating a Value Based Farming Network",
                    "linker" => "//www.vanguardngr.com/2022/01/agrorite-creating-a-value-based-farming-network/"
                ),

                array(
                    "images" => "Techpoint.webp",
                    "house" => "Techpoint",
                    "posting" => "How Agrorite is creating resilience against food insecurity",
                    "linker" => "//techpoint.africa/2021/07/29/how-agrorite-is-creating-resilience-against-food-insecurity/"
                ),

                // array(
                //     "images" => "vanguard.png",
                //     "house" => "Vanguard",
                //     "posting" => "How Agrorite is creating resilience against food insecurity",
                //     "linker" => "//www.vanguardngr.com/2021/07/how-agrorite-creating-resilience-against-food-insecurity/"
                // ),

                array(
                    "images" => "vanguard.png",
                    "house" => "Vanguard",
                    "posting" => "Agrorite: Uplifting Farmers Amidst Covid-19",
                    "linker" => "//www.vanguardngr.com/2021/01/agrorite-uplifting-farmers-amidst-covid-19/"
                ),

                array(
                    "images" => "Startupill-logo.webp",
                    "house" => "Startupill, London",
                    "posting" => "101 Quality Farming Startups To Look Out For In 2021",
                    "linker" => "//startupill.com/101-quality-farming-startups-to-look-out-for-in-2021/"
                ),

                array(
                    "images" => "businessday.webp",
                    "house" => "Business Day",
                    "posting" => "How Agrorite uplifts smallholder farmers amid COVID-19",
                    "linker" => "//businessday.ng/agriculture/article/how-agrorite-uplifts-smallholder-farmers-amid-covid-19"
                ),

                array(
                    "images" => "nairametrics-logo.webp",
                    "house" => "Nairametrics",
                    "posting" => "Agrorite leading the fight against food insecurity using Agtech",
                    "linker" => "//nairametrics.com/2020/09/14/agrorite-leading-the-fight-against-food-insecurity-using-agtech/"
                ),

                array(
                    "images" => "vanguard.png",
                    "house" => "Vanguard",
                    "posting" => "COVID-19: Agrorite, Netherlands, NABDA partner Agrobusiness times for food security",
                    "linker" => "//www.vanguardngr.com/2020/09/covid-19-netherlands-nabda-agrorite-partner-agrobusiness-times-for-food-security-conference/amp/"
                ),

                array(
                    "images" => "Spacein.webp",
                    "house" => "Space In Africa",
                    "posting" => "Agrorite To Deploy Satellite-based Farm Management Tool For Nigerian Farmers",
                    "linker" => "//africanews.space/africa4future2020-agrorite-to-deploy-satellite-based-farm-management-tool-for-nigerian-farmers"
                ),

                array(
                    "images" => "airbus.webp",
                    "house" => "Airbus Aerospace",
                    "posting" => "Africa4Future welcomes 2020 cohort",
                    "linker" => "//www.airbus.com/newsroom/stories/Africa-4-Future-2020.html"
                ),

                array(
                    "images" => "Spacein.webp",
                    "house" => "Space In Africa",
                    "posting" => "Agrorite To Deploy Satellite-based Farm Management Tool For Nigerian Farmers",
                    "linker" => "//africanews.space/africa4future2020-agrorite-to-deploy-satellite-based-farm-management-tool-for-nigerian-farmers"
                ),

                array(
                    "images" => "businessday.webp",
                    "house" => "Business Day",
                    "posting" => "Achieving food security in Africa with the Agrorite approach",
                    "linker" => "//businessday.ng/agriculture/article/achieving-food-security-in-africa-with-the-agrorite-approach/"
                ),

                array(
                    "images" => "vanguard.png",
                    "house" => "Vanguard",
                    "posting" => "Agrorite determines to achieve food security in Africa",
                    "linker" => "//www.vanguardngr.com/2019/10/agrorite-determines-to-achieve-food-security-in-africa-toyosi-ayodele/"
                ),

                array(
                    "images" => "punchng.webp",
                    "house" => "Punchng",
                    "posting" => "Agrorite: Digital platform spurring agricultural prosperity",
                    "linker" => "//punchng.com/agrorite-digital-platform-spurring-agricultural-prosperity/"
                ),

                array(
                    "images" => "dailypost.webp",
                    "house" => "Dailypostg",
                    "posting" => "Agrorite presents an opportunity to partner and earn in Agriculture",
                    "linker" => "//dailypost.ng/2019/07/13/agrorite-presents-opportunity-partner-earn-agriculture/"
                ),

                array(
                    "images" => "farmcon.webp",
                    "house" => "African farming",
                    "posting" => "Agrorite unveils digital platform for smallholder farmers",
                    "linker" => "//www.africanfarming.net/crops/agriculture/agrorite-com-unveils-digital-platform-for-smallholder-farmers"
                ),

            );

            foreach ($mediaLister as $mPost) {

            ?>
            <div class="col-12 col-md-6 col-lg-3 mb-30"> 

                <div class="card-M featured-item shadow">

                    <div class="card-body cardb ptb-45">

                        <div class="icon circle-icon1 mx-auto">

                            <img src="<?php echo $urlLink; ?>/assets/img/media/<?php echo $mPost["images"]; ?>" alt="Member Image">

                        </div>

                            <h5><?php echo $mPost["house"]; ?></h5>

                            <p class="mb-10"><?php echo $mPost["posting"]; ?></p>

                            <!-- <a class="item-link link-btn" href="//www.vanguardngr.com/2022/01/agrorite-creating-a-value-based-farming-network/" target="_blank">Read More</a> -->

                            <a class="item-link link-btn" href="<?php echo $mPost["linker"]; ?>" target="_blank">Read More</a>

                    </div>

                </div>

            </div>

            <?php } ?>
        </div>
    </div>
</section>

<?php require_once "footer.php";?>


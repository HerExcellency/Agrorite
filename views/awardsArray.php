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
                    <li class="nav-item"><a href="awards" class="nav-link active">Awards</a></li>
                    <li class="nav-item"><a href="media" class="nav-link">Media</a></li>
                    <li class="nav-item"><a href="photos" class="nav-link">Photos</a></li>
                    <li class="nav-item"><a href="videos" class="nav-link">Video</a></li>
                </ul>
            </div>
        </div>
<!-- Award Section Start -->
    <div class="section-ptb1 bg-white">
<!-- Featured Section Start -->
        <section class="section-pb">
            <div class="container">
                <div class="row">
                    <?php
                        $awardArray = array(
                            array(
                                "imgAwd" => "30under30plaque.webp",
                                "hdAwd" => " 30 Under 30 Africa awards. (December, 2021).",
                                "pAwd" => "Our Founder, Toyosi Ayodele was honored for his outstanding contributions to the agricultural sector at the 30 Under 30 Africa awards.",
                            ),

                            array(
                                "imgAwd" => "awardNov.jpeg",
                                "hdAwd" => "Africa's most impactful Agricultural brand 2021 (November, 2021).",
                                "pAwd" => "Agrorite was awarded Africa's most impactful Agricultural brand 2021 at the Global quality excellence and African brands award.",
                            ),

                            array(
                                "imgAwd" => "Top50.webp",
                                "hdAwd" => "50 influential CEOS in Africa (August, 2021).",
                                "pAwd" => "Our Founder & CEO, Toyosi Ayodele was awarded 50 influential CEOs in Leadership and Business Sustainability in Africa.",
                            ),
                            array(
                                "imgAwd" => "toyounder40.webp",
                                "hdAwd" => "40under40 CEO in Nigeria (June, 2021).",
                                "pAwd" => "Young Entrepreneurs International Summit's award to Our CEO Toyosi Ayodele.",
                            ),
                            array(
                                "imgAwd" => "BrandExcellenceAward.webp",
                                "hdAwd" => "West Africa's Brand Excellence Awards (February, 2021).",
                                "pAwd" => "West Africa's  Best Digital Agricultural Brand Of The Decade. Courtesy of The Institute of Brand Management of Nigeria.",
                            ),
                            array(
                                "imgAwd" => "ecowasAWARD.webp",
                                "hdAwd" => "Award/Recognition (February, 2021).",
                                "pAwd" => "Nelson Mandela Leadership Award of Excellence and Integrity To The CEO as\"ECOWAS Youth Ambassador\".",
                            ),
                            array(
                                "imgAwd" => "award.png",
                                "hdAwd" => "Award/Recognition (January, 2021).",
                                "pAwd" => "\"Golden Role Model Award\" To The CEO On Humanitarian Services.",
                            ),
                            array(
                                "imgAwd" => "theAfrica.webp",
                                "hdAwd" => "Africa's Fintech Innovators Merit Award (August, 2020).",
                                "pAwd" => "Africa's Most Innovative Digital Agriculture Platform Brand Of The Year 2020.",
                            ),
                            array(
                                "imgAwd" => "uktech.webp",
                                "hdAwd" => "Uk International Tech Hub (June, 2020).",
                                "pAwd" => "Go Global Virtual Programme 2020 Participant.",
                            ),
                            array(
                                "imgAwd" => "airbus.webp",
                                "hdAwd" => "Africa4Future 2020 Cohort (April, 2020).",
                                "pAwd" => "Selected among the 10 tech enabled startups in Africa.",
                            ),
                            array(
                                "imgAwd" => "weforgood.webp",
                                "hdAwd" => "Award/Recognition (March, 2020).",
                                "pAwd" => "COO Listed among 100 women creating a better Africa.",
                            ),
                            array(
                                "imgAwd" => "dubai.webp",
                                "hdAwd" => "Listed (January, 2020).",
                                "pAwd" => "Coporate Member, Dubai Chamber of Commerce.",
                            ),
                            array(
                                "imgAwd" => "autft.webp",
                                "hdAwd" => "Finalist (January, 2020).",
                                "pAwd" => "COO Recognized as top 10 African-UK Female Tech Founder 2020.",
                            ),
                            array(
                                "imgAwd" => "economic.webp",
                                "hdAwd" => "Finalist (December, 2019).",
                                "pAwd" => "Nigerian Economic Summit, Start-up Pitch Finalist.",
                            ),
                            array(
                                "imgAwd" => "5gcitizens.webp",
                                "hdAwd" => "Award/Recognition (September, 2019).",
                                "pAwd" => "CEO Listed as 5th Global Entreps and 5G Citizens International Congress Member.",
                            ),
                            array(
                                "imgAwd" => "sdgsRecog-min.webp",
                                "hdAwd" => "Award/Recognition (July, 2019).",
                                "pAwd" => "SDG Sustainable Development Solutions Africa Awardee.",
                            ),
                            array(
                                "imgAwd" => "ngr.webp",
                                "hdAwd" => "Award/Recognition (May, 2019).",
                                "pAwd" => "Presidential Award To The CEO On Social Impact.",
                            ),
                            array(
                                "imgAwd" => "startupturkey.webp",
                                "hdAwd" => "Listed (June, 2019).",
                                "pAwd" => "100 Most Promising Startups by Startup Instabul, Turkey.",
                            ),
                           
                        );

                        foreach ($awardArray as $divAward) {
            
                        ?>
                        
                        <div class="col-12 col-md-6 col-lg-6 mb-30 mb-sm-30 mb-md-30">
                            <div class="card featured-item shadow">
                                <div class="card-body my-card ptb-45">
                                    <div class="icon mb-30 mx-auto myimage">
                                        <img src="<?php echo $urlLink; ?>/assets/img/awards/<?php echo $divAward["imgAwd"]; ?>" alt="Agrorite Award Image">
                                    </div>
                                    <div class="ontop">
                                        <h4><?php echo $divAward["hdAwd"]; ?></h4>
                                        <p class="mb-20"><?php echo $divAward["pAwd"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php require_once "footer.php";?>
<?php 
$dashboardUrl = "http://192.168.4.116/onlineagro/dashboard"; 
// $dashboardUrl = "http://localhost/onlineagro/dashboard"; 
// $dashboardUrl = "https://agrorite.com/dashboard"; 
// $baseUrl = "http://localhost/onlineagro"; 
// $baseUrl = "https://agrorite.com"; 
$baseUrl = "http://192.168.4.116/onlineagro"; 
session_start();
$email = @$_SESSION['email'];
@$logged = $_SESSION['login'];
if(!$logged){
    echo "<script>window.location = '/login'</script>";
}
// exit($_SERVER["DOCUMENT_ROOT"]);
require_once $_SERVER["DOCUMENT_ROOT"] ."/onlineagro/scripts/php/functions.php";

$fetchDetails = fetchUser($email);
$userPicture = $fetchDetails[0]->picture;
$firstName = $fetchDetails[0]->fname;
$lastName = $fetchDetails[0]->lname;
$fullName = $firstName . ' ' . $lastName;
$mobile = $fetchDetails[0]->phone;
$bankName = $fetchDetails[0]->bank_name;
$accountNumber = $fetchDetails[0]->bank_acct_number;
$accountName = $fetchDetails[0]->bank_acct_name;
$userAddress = $fetchDetails[0]->street_add;
$nationality = $fetchDetails[0]->nationality;
$residence = $fetchDetails[0]->country;
$userId = $fetchDetails[0]->id;
$userGender = $fetchDetails[0]->sex;
$nextOfKin = $fetchDetails[0]->kin_name;
$nokMobile = $fetchDetails[0]->kin_phone;
$nokRelationship = $fetchDetails[0]->relationship;
$nokAddress = $fetchDetails[0]->kin_add;
$dateJoinRaw = $fetchDetails[0]->date_created;
$dateJoin = time_elapsed_string($dateJoinRaw);
//fetch the list of investement of the user to be use in the sponsored farm
$countFarm = fetchUserFarm($userId);
//to diplay on the index page the current farm running
$countFarm2 = fetchUserFarmCount($userId);
//fetch the number of investment of the user to be used in the index page
$userCount = mysqli_num_rows($countFarm);
//select all farms available
$allFarmsLimit = fetchAllFarmsLimit();
$allFarmsClosed = fetchAllFarmsClosed();
$allFarmsOpened = fetchAllFarmsOpened();
$allFarmsSoon = fetchAllFarmsSoon();
$allFarms = fetchAllFarmsInvestment();
$pendingInvestment = pendingInvestment($userId);
$farmExpire = farmExpire($userId);
if(mysqli_num_rows($farmExpire) > 0){
    while($row = mysqli_fetch_assoc($farmExpire)){
        $startDate = $row['date_started'];
        $endDate = $row['date_end'];
        $investmentId = $row['id'];
        $todayDate = date("d-m-Y");
        $remain = round(abs(strtotime($startDate) - strtotime($endDate))/86400);
        $remain2 = round(abs(strtotime($startDate) - strtotime($todayDate))/86400);
        if($remain2 >= $remain){
            $updateFarm = updateInvestment($investmentId);
        }
    }        
}




?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Agrorite - User Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo $baseUrl; ?>/assets/img/favicon.png" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="<?php echo $dashboardUrl; ?>/assets/css/app.min.css" rel="stylesheet">
    <!-- Light Gallery Css -->
    <!-- <link href="//www.radixtouch.in/templates/admin/blize/source/light/assets/js/bundles/lightgallery/dist/css/lightgallery.css" rel="stylesheet"> -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="<?php echo $dashboardUrl; ?>/assets/css/style.css" rel="stylesheet" />
    <!-- <link href="<?php echo $dashboardUrl; ?>/assets/css/anniversary.css" rel="stylesheet" /> -->

    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo $dashboardUrl; ?>/assets/css/styles/all-themes.css" rel="stylesheet" />
    
    <style>
        .lg-actions .lg-next:before {
            content: ">>";
        }
        .lg-actions .lg-prev:after {
            content: "<<";
        }
        .lg-toolbar{
            display:none !important;
        }
        .lg-outer .lg-toogle-thumb:after {
            content: "";
        }
        
    </style>
</head>

<body class="light">
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.html#" onClick="return false;" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="index.html#" onClick="return false;" class="bars"></a>
                <a class="navbar-brand" href="<?php echo $dashboardUrl;?>/index">
                    <img src="<?php echo $baseUrl; ?>/assets/img/mylog.png" alt="" />
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#" onClick="return false;" class="sidemenu-collapse">
                            <i data-feather="align-justify"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Full Screen Button -->
                    <li class="fullscreen">
                        <a href="javascript:;" class="fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <!-- #END# Full Screen Button -->
                    <li class="dropdown user_profile">
                        <div class="chip dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $baseUrl; ?>/assets/img/user/<?php if($userPicture){echo $userPicture;}else{echo 'user-avatar.png';} ?>" alt="<?php echo $firstName; ?>">
                           Hello, <?php echo $firstName; ?>
                        </div>
                        <ul class="dropdown-menu pullDown">
                            <li class="body">
                                <ul class="user_dw_menu">
                                    <li>
                                        <a href="<?php echo $dashboardUrl; ?>/profile">
                                            <i class="material-icons">person</i>Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $baseUrl; ?>/faq">
                                            <i class="material-icons">help</i>Help
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $baseUrl; ?>/logout">
                                            <i class="material-icons">power_settings_new</i>Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <div>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        <a href="<?php echo $baseUrl; ?>">
                            <i data-feather="home"></i>
                            <span style="color:#07c507">Visit Website</span>
                        </a>
                    </li>
                    <li class="<?php if($page === 'home'){ echo 'active';} ?>">
                        <a href="<?php echo $dashboardUrl; ?>/index">
                            <i data-feather="grid"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php if($page === 'myfarm'){ echo 'active';} ?>">
                        <a href="<?php echo $dashboardUrl; ?>/sponsored-farms">
                            <i class="fas fa-envelope-open-text"></i>
                            <span>My Farms</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle">
                            <i class="fas fa-feather"></i>
                            <span>Our Farms</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php if($page === 'comingfarm'){ echo 'active';} ?>">
                                <a href="<?php echo $dashboardUrl; ?>/open-soon">Up Coming Farms</a>
                            </li>
                            <li class="<?php if($page === 'openfarm'){ echo 'active';} ?>">
                                <a href="<?php echo $dashboardUrl; ?>/open-farm">Open Farms</a>
                            </li>
                            <li class="<?php if($page === 'closedfarm'){ echo 'active';} ?>">
                                <a href="<?php echo $dashboardUrl; ?>/closed-farm">Closed Farms</a>
                            </li>
                            <li class="<?php if($page === 'allfarm'){ echo 'active';} ?>">
                                <a href="<?php echo $dashboardUrl; ?>/all-farms">All Farms</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if($page === 'profile'){ echo 'active';} ?>">
                        <a href="<?php echo $dashboardUrl; ?>/profile">
                            <i class="fas fa-user-tie"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $baseUrl; ?>/logout">
                        <i class="material-icons">power_settings_new</i>
                        <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </div>
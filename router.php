<?php
/**
 * Router
 * This script routes url requests to the views that will handle them.
 */
$view = $_GET['view'];

if(strstr($view, "/")){
    $replace_name = preg_replace('/^\/+|\/+$/', '', $view);
    $path_name = strstr($replace_name, "/") ?  explode("/", $replace_name) : $replace_name;
}else{
    $path_name = $view;
}
$page = is_array($path_name) ? $path_name[1] : $path_name;


$category = [
  'all-farm',
  'open-farm',
  'open-soon',
  'closed-farm',
  'index',
  'sponsored-farms',
  'profile',
  'my-active-farm',
  'farm-update'
];
$controller = [
    'dashboard',
    'reset-my-password',
    'verify'
];
if(is_array($path_name)){
    if(in_array($path_name[0], $controller)){
        require_once 'scripts/php/functions.php';
       if($path_name[0] === 'dashboard' && $path_name[1] === ''){
            require_once 'dashboard/index.php';
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'index'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/index.php';
            }
            
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'all-farms'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/all-farms.php';
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'closed-farm'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/closed-farm.php';
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'open-farm'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/open-farm.php';
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'open-soon'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/open-soon.php';
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'sponsored-farms'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/sponsored-farms.php';
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'profile'){
            if(@$path_name[2] != ''){
                require_once 'views/404.php';
            }else{
                require_once 'dashboard/profile.php';
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'farms'){
            if($path_name[2] != ''){
                $slug = $path_name[2];
                $farmDetails = fetchFarmDetails($slug);
                if(mysqli_num_rows($farmDetails) === 0){
                    require_once "views/404.php";
                }else{
                    require_once 'dashboard/farm-details.php';
                }
            }else{
                require_once "views/404.php";
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'farm-update'){
            if($path_name[2] != ''){
                $slug = $path_name[2];
                $farmDetails = fetchFarmDetails($slug);
                if(mysqli_num_rows($farmDetails) === 0){
                    require_once "views/404.php";
                }else{
                    require_once 'dashboard/farm-update-me.php';
                }
            }else{
                require_once "views/404.php";
            }
        }elseif($path_name[0] === 'dashboard' && $path_name[1] === 'sponsor'){
            if($path_name[2] != ''){
                $slug = $path_name[2];
                $farmDetails = fetchFarmDetails($slug);
                if(mysqli_num_rows($farmDetails) === 0){
                    require_once "views/404.php";
                }else{
                    require_once 'dashboard/cart-item.php';
                }
            }else{
                require_once "views/404.php";
            }
        }elseif($path_name[0] === 'reset-my-password'){
            if($path_name[1] != ""){
                $resetPin = $path_name[1];
                $checkPin = checkPwdPin($resetPin);
                if(count($checkPin) === 0){
                    require_once 'views/404.php';
                }else{
                    require_once 'views/password-my-update.php';
                }
            }else{
                require_once "views/404.php";
            }
        }elseif($path_name[0] === 'verify'){
            if($path_name[1] != ""){
                $activationPin = $path_name[1];
                $checkPathName = checkVerifyPin($activationPin);
                require_once 'views/my-verification_token.php';
            }else{
                require_once 'views/404.php';
            }
        }else{
            require_once 'views/404.php';
        }
    }else{
        require_once 'views/404.php';
    }
    
}

else{
    // require isset($pages[$page]) ? $pages[$page] : $pages['404'];
    if($page === 'index'){
        header('Location: ./');
    }elseif($page === 'sidebar'){
        require_once 'views/404.php';
    }
    require file_exists('views/'.$page. '.php') ? 'views/'.$page. '.php' : 'views/404.php';
}

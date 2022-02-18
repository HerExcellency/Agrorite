<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$email = $_POST["email"]; 
$password = $_POST["password"];

// array for JSON response
$androidResponse = array();


$fetch = fetchUser($email);
if(array_key_exists('error',  $fetch)){
    echo json_encode("Invalid details");
}


$dbPassword = $fetch[0]->password;
$userId = $fetch[0]->id;
$firstname = $fetch[0]->fname;
$lastname = $fetch[0]->lname;
$userImg = $fetch[0]->picture;

if(count($fetch) === 0){
    $androidResponse["message"] = 'Email not found';
        // echo JSON response
        echo json_encode($androidResponse);
}else{
    
    if (substr($dbPassword, 0, 1) == "$"){
        // Password already converted, verify using password_verify
        $passwordVerify = password_verify($password, $dbPassword);
        if(!$passwordVerify){
            $androidResponse["message"] = 'false';
            // echo JSON response
            echo json_encode($androidResponse);
        }else{
            $androidResponse["message"] = 'true';
            $androidResponse["userId"] = $userId;
            $androidResponse["firstname"] = $firstname;
            $androidResponse["email"] = $email;
            $androidResponse["userImg"] = $userImg;
            $androidResponse["lastname"] = $lastname;
            // echo JSON response 
            echo json_encode($androidResponse);
        }
    }else{
        // User still using the old MD5, update it!
        if (md5($password) != $dbPassword){
            $androidResponse["message"] = 'false';
            // echo JSON response
            echo json_encode($androidResponse);
        }else{
            $androidResponse["message"] = 'true';
            $androidResponse["userId"] = $userId;
            $androidResponse["firstname"] = $firstname;
            $androidResponse["email"] = $email;
            $androidResponse["userImg"] = $userImg;
            $androidResponse["lastname"] = $lastname;
            // echo JSON response
            echo json_encode($androidResponse);
        }
    }
    
}


 
?>
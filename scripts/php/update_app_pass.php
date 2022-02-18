<?php
require_once 'functions.php';
require_once 'helpers/helper.php';
// Getting Post value
$email= $_POST["email"]; 
$oldpassword= $_POST["old_pass"]; 
$newpassword= $_POST["new_pass"]; 


// array for JSON response
$androidResponse = array();


$fetch = fetchUser($email);
if(array_key_exists('error',  $fetch)){
    $androidResponse["message"] = 'Please try again later';
        // echo JSON response
        echo json_encode($androidResponse);
}
if(count($fetch) === 0){
    $androidResponse["message"] = 'Please try again later';
        // echo JSON response
        echo json_encode($androidResponse);
}
$dbPass = $fetch[0]->password;

if (substr($dbPass, 0, 1) == "$"){
    // Password already converted, verify using password_verify
    $passwordVerify = password_verify($oldpassword, $dbPass);
    if(!$passwordVerify){
        $androidResponse["message"] = 'Invalid old password';
        // echo JSON response
        echo json_encode($androidResponse);
    }else{
        $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);

        $updatePassword = updatePassword($email, $password_hash);
        if($updatePassword === TRUE){
            $androidResponse["message"] = 'Your password has been updated successfully';
        // echo JSON response
        echo json_encode($androidResponse);
        }else{
            $androidResponse["message"] = 'Please try again later';
        // echo JSON response
        echo json_encode($androidResponse);
        
        } 
    }
}
else{
    // User still using the old MD5, update it!
    if (md5($oldpassword) != $dbPass){
        $androidResponse["message"] = 'Invalid old password';
        // echo JSON response
        echo json_encode($androidResponse);
    }else{
        //hash the new password
        $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);

        $updatePassword = updatePassword($email, $password_hash);
        if($updatePassword === TRUE){
            $androidResponse["message"] = 'Your password has been updated successfully';
        // echo JSON response
        echo json_encode($androidResponse);
        }else{
            $androidResponse["message"] = 'Please try again later';
        // echo JSON response
        echo json_encode($androidResponse);
        
        }                                                           
    }
}

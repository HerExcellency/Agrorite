<?php
require_once 'functions.php';
require_once 'helpers/helper.php';
// Getting Post value
$email= $_POST["email"]; 
$oldpassword= $_POST["oldpassword"]; 
$newpassword= $_POST["newpassword"]; 
/**
 * VALIDATION FOR PASSWORD STARTS HERE
 */
if($oldpassword === ''){
    return helper::Output_Error(null, "Old Password field cannot be empty");
}
if($newpassword === ''){
    return helper::Output_Error(null, "New Password field cannot be empty");
}
if(strlen($newpassword) < 6){
    return helper::Output_Error(null, "Password is not strong enough");
}
/**
* VALIDATION FOR EMAIL STARTS HERE
*/
if($email === ''){
    return helper::Output_Error(null, "Email field cannot be empty");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return helper::Output_Error(null, "Please put in a valid email");
}
$fetch = fetchUser($email);
if(array_key_exists('error',  $fetch)){
    return helper::Output_Error(null, "Oops there has been a problem, please try again");
}
if(count($fetch) === 0){
    return helper::Output_Error(null, "Sorry this email address is not registered");
}
$dbPass = $fetch[0]->password;

if (substr($dbPass, 0, 1) == "$"){
    // Password already converted, verify using password_verify
    $passwordVerify = password_verify($oldpassword, $dbPass);
    if(!$passwordVerify){
        return helper::Output_Error(null, "Invalid Old Password");
    }else{
        $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);

        $updatePassword = updatePassword($email, $password_hash);
        if($updatePassword === TRUE){
            return helper::Output_Success(["success"=>"Your password has been updated successfully, page will redirect soon"]);
        }else{
            return helper::Output_Error(null, "Sorry we couldn't process your request please try again");
        
        } 
    }
}
else{
    // User still using the old MD5, update it!
    if (md5($oldpassword) != $dbPass){
        return helper::Output_Error(null, "Invalid Password");
    }else{
        //hash the new password
        $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);

        $updatePassword = updatePassword($email, $password_hash);
        if($updatePassword === TRUE){
            return helper::Output_Success(["success"=>"Your password has been updated successfully, page will redirect soon"]);
        }else{
            return helper::Output_Error(null, "Sorry we couldn't process your request please try again");
        
        }                                                           
    }
}




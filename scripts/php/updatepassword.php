<?php
require_once 'functions.php';
require_once 'helpers/helper.php';
// Getting Post value
$email= $_POST["email"]; 
$password= $_POST["password"]; 
/**
 * VALIDATION FOR PASSWORD STARTS HERE
 */
if($password === ''){
    return helper::Output_Error(null, "Password field cannot be empty");
}
if(strlen($password) < 6){
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
//hash the password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$updatePassword = updatePassword($email, $password_hash);
if($updatePassword === TRUE){
    return helper::Output_Success(["success"=>"Your password has been updated successfully"]);
}else{
    return helper::Output_Error(null, "Sorry we couldn't process your request please try again");
}


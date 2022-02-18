<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$fullname = $_POST["fullname"]; 
$phone = $_POST["phone"]; 
$email = $_POST["email"]; 
$address = $_POST['address'];
$relationship = $_POST['relationship'];
/**
 * VALIDATION FOR FULLNAME STARTS HERE
 */
if (empty($fullname)) {
    return helper::Output_Error(null, "Full Name is required");
}
if($fullname === ''){
    return helper::Output_Error(null, "Fullname field cannot be empty");
}
if(strlen($fullname) < 2){
    return helper::Output_Error(null, "Please put in a valid fullname");
}
if(!preg_match("/^[a-zA-Z'-]/", $fullname)){
    return helper::Output_Error(null, "Fullname can only contain Alphabet and Numbers");
}

/**
 * VALIDATION FOR EMAIL STARTS HERE
 */
if (empty($email)) {
    return helper::Output_Error(null, "Email is required");
}
if($email === ''){
    return helper::Output_Error(null, "Email field cannot be empty");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return helper::Output_Error(null, "Please put in a valid email");
}
/**
 * VALIDATION FOR PHONE STARTS HERE
 */
if (empty($phone)) {
    return helper::Output_Error(null, "Phone Number is required");
}
if($phone === ''){
    return helper::Output_Error(null, "Phone number field cannot be empty");
}
if (strlen($phone) < 6 || strlen($phone) > 16) {
    return helper::Output_Error(null, "Please put in a valid mobile number");
}
if(!preg_match("/^[0-9]/", $phone)){
    return helper::Output_Error(null, "Please mobile field can only be number");
}
/**
 * VALIDATION FOR LASTNAME STARTS HERE
 */
if (empty($relationship)) {
    return helper::Output_Error(null, "relationship is required");
}
if($relationship === ''){
    return helper::Output_Error(null, "What's your relationship with your next of kin");
}
if(strlen($relationship) < 2){
    return helper::Output_Error(null, "Please put in a valid relationship. Eg Wife, Brother");
}
/**
 * VALIDATION FOR ADDRESS STARTS HERE
 */
if (empty($address)) {
    return helper::Output_Error(null, "Address is required");
}
if($address === ''){
    return helper::Output_Error(null, "Address field cannot be empty");
}


/**
 * CHECK IF A USER EXIST WITH THE EMAIL ADDRESS
 */
$fetch = fetchUser($email);
// database error
if(array_key_exists('error',  $fetch)){
    return helper::Output_Error(null, "Oops there was an error performing this task please try again later");
}
if(count($fetch) === 0){
    return helper::Output_Error(null, "Invalid User");
}


$update = updatenextOfKin($fullname, $email, $phone, $address, $relationship);
if($update === TRUE){
    //send mail with link
    return helper::Output_Success(["success"=>"Your information have been updated"]);
}else{
    return helper::Output_Error(null, "Oops there was an error please try again");
}
 
?>
<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$firstname = $_POST["firstname"]; 
$lastname = $_POST["lastname"]; 
$phone = $_POST["phone"]; 
$email = $_POST["email"]; 
$residence = $_POST['residence'];
$nationality = $_POST['nationality'];
$gender = $_POST['gender'];
$dob = $_POST['dateofbirth'];
/**
 * VALIDATION FOR FIRSTNAME STARTS HERE
 */
if($firstname === ''){
    return helper::Output_Error(null, "Firstname field cannot be empty");
}
if(strlen($firstname) < 2){
    return helper::Output_Error(null, "Please put in a valid firstname");
}
if(!preg_match("/^[a-zA-Z'-]/", $firstname)){
    return helper::Output_Error(null, "Firstname can only contain Alphabet and Numbers");
}
/**
 * VALIDATION FOR LASTNAME STARTS HERE
 */
if($lastname === ''){
    return helper::Output_Error(null, "Lastname field cannot be empty");
}
if(strlen($lastname) < 2){
    return helper::Output_Error(null, "Please put in a valid lastname");
}
if(!preg_match("/^[a-zA-Z'-]/", $lastname)){
    return helper::Output_Error(null, "Lastname can only contain Alphabet and Numbers");
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
/**
 * VALIDATION FOR PHONE STARTS HERE
 */
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
 * VALIDATION FOR COUNTRY OF RESIDENCE STARTS HERE
 */
if($residence === ''){
    return helper::Output_Error(null, "Country of residence field cannot be empty");
}
if(empty($residence)){
    return helper::Output_Error(null, "Country of residence field cannot be empty");
}
if(strlen($residence) < 2){
    return helper::Output_Error(null, "Please put in a valid country of residence");
}
/**
 * VALIDATION FOR COUNTRY OF ORIGIN STARTS HERE
 */
if($nationality === ''){
    return helper::Output_Error(null, "Country of Origin field cannot be empty");
}
if(empty($nationality)){
    return helper::Output_Error(null, "Country of Origin field cannot be empty");
}
if(strlen($nationality) < 2){
    return helper::Output_Error(null, "Please put in a valid country of Origin");
}

if($gender === ''){
    return helper::Output_Error(null, "Gender field cannot be empty");
}


/**
 * CHECK IF A USER EXIST WITH THE EMAIL ADDRESS
 */
$fetch = fetchUser($email);
// database error
if(array_key_exists('error',  $fetch)){
    return helper::Output_Error(null, "Opps there was an error performing this task please try again later");
}
if(count($fetch) === 0){
    return helper::Output_Error(null, "Invalid User");
}


$update = updateAgroriter($firstname, $lastname, $email, $phone, $residence, $nationality, $gender, $dob);
if($update === TRUE){
    //send mail with link
    return helper::Output_Success(["success"=>"Your information have been updated"]);
}else{
    return helper::Output_Error(null, "Oops there was an error please try again");
}
 
?>
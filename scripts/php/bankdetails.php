<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$bankname = $_POST["bankname"]; 
$accountname = $_POST["accountname"]; 
$accountnumber = $_POST["accountnumber"]; 
$email = $_POST["email"]; 
$password = $_POST["password"];
/**
 * VALIDATION FOR BANKNAME STARTS HERE
 */
if (empty($bankname)) {
    return helper::Output_Error(null, "Bank Name is required");
}
if($bankname === ''){
    return helper::Output_Error(null, "bankname field cannot be empty");
}
if(strlen($bankname) < 2){
    return helper::Output_Error(null, "Please put in a valid bankname");
}
/**
 * VALIDATION FOR accountNAME STARTS HERE
 */
if (empty($accountname)) {
    return helper::Output_Error(null, "Account Name is required");
}
if($accountname === ''){
    return helper::Output_Error(null, "accountname field cannot be empty");
}
if(strlen($accountname) < 2){
    return helper::Output_Error(null, "Please put in a valid accountname");
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
 * VALIDATION FOR accountnumber STARTS HERE
 */
if (empty($accountnumber)) {
    return helper::Output_Error(null, "Account Number is required");
}
if($accountnumber === ''){
    return helper::Output_Error(null, "accountnumber number field cannot be empty");
}
if (strlen($accountnumber) != 10) {
    return helper::Output_Error(null, "Please put in a valid account number");
}
if(!preg_match("/^[0-9]/", $accountnumber)){
    return helper::Output_Error(null, "Please account field can only be number");
}
/**
 * VALIDATION FOR PASSWORD STARTS HERE
 */
if (empty($password)) {
    return helper::Output_Error(null, "Password is required");
}
if($password === ''){
    return helper::Output_Error(null, "Password field cannot be empty");
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
    return helper::Output_Error(null, "invalid user");
}
$dbPassword = $fetch[0]->password;

if (substr($dbPassword, 0, 1) == "$"){
    // Password already converted, verify using password_verify
    $passwordVerify = password_verify($password, $dbPassword);
    if(!$passwordVerify){
        return helper::Output_Error(null, "Invalid Password");
    }else{
        $updateAccountDetails = updateAccountDetails($bankname, $accountname, $accountnumber, $email);
        if($updateAccountDetails === TRUE){
            //send mail with link
            return helper::Output_Success(["success"=>"Your account details have been updated"]);
        }else{
            return helper::Output_Error(null, "Oops there was an error please try again");
        }
    }
}
else{
    // User still using the old MD5, update it!
    if (md5($password) != $dbPassword){
        return helper::Output_Error(null, "Invalid Password");
    }else{
        $updateAccountDetails = updateAccountDetails($bankname, $accountname, $accountnumber, $email);
        if($updateAccountDetails === TRUE){
            //send mail with link
            return helper::Output_Success(["success"=>"Your account details have been updated"]);
        }else{
            return helper::Output_Error(null, "Oops there was an error please try again");
        }
    }
}
 
?>
<?php 
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$amountToPay = filter_var($_POST["amount"], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
$invoice = $_POST["invoice"];
$invoiceNumber = 'PST'.$invoice;
$farmId = $_POST["farmid"];
$userId = $_POST["userid"];
$farmUnit = $_POST["unit"];

/**
 * VALIDATION FOR EMAIL STARTS HERE
 */
if (empty($userId)) {
    return helper::Output_Error(null, "User Id is required");
}
if($userId === ''){
    return helper::Output_Error(null, "User Id field cannot be empty");
}
/**
 * VALIDATION FOR AMOUNT STARTS HERE
 */
if (empty($amountToPay)) {
    return helper::Output_Error(null, "Amount is required");
}
if($amountToPay === ''){
    return helper::Output_Error(null, "Amount field cannot be empty");
}
/**
 * VALIDATION FOR farm unit STARTS HERE
 */
if (empty($farmUnit)) {
    return helper::Output_Error(null, "Farm Unit is required");
}
if($farmUnit === ''){
    return helper::Output_Error(null, "Farm Unit field cannot be empty");
}
/**
 * VALIDATION FOR INVOICE NUMBER STARTS HERE
 */
if (empty($invoiceNumber)) {
    return helper::Output_Error(null, "Invoice number is required");
}
if($invoiceNumber === ''){
    return helper::Output_Error(null, "Invoice Number field cannot be empty");
}
if(substr($invoiceNumber, 0, 3) != 'PST'){
    return helper::Output_Error(null, "Invalid Invoice number");
}
/**
 * VALIDATION FOR Farm Id STARTS HERE
 */
if (empty($farmId)) {
    return helper::Output_Error(null, "Farm Id is required");
}
if($farmId === ''){
    return helper::Output_Error(null, "Farm Id field cannot be empty");
}

$fetch = fetchUserId($userId);
// database error
if(array_key_exists('error',  $fetch)){
    return helper::Output_Error(null, "Oops there was an error performing this task please try again later");
}
if(count($fetch) === 0){
    return helper::Output_Error(null, "invalid user");
}
$userEmail = $fetch[0]->email;
$userFirstName = $fetch[0]->fname;
$fetchFarm = fetchFarmDetailsById($farmId);
if(count($fetchFarm) === 0){
    return helper::Output_Error(null, "Invalid Farm Selected");
}
$farmName = $fetchFarm[0]->title;
$date_created = date("d-m-Y");
$time_created = date("h:i:s A");
$submitFarmDetails = sponsorFarm($farmId, $userId, $amountToPay, $invoiceNumber, $date_created, $time_created, $farmUnit);
if($submitFarmDetails === TRUE){
    return helper::Output_Success(["success"=>"Your payment was successful"]);
}else{
    return helper::Output_Error(null, "Oops there was an error please try again");
}


?>
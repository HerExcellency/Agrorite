<?php
require_once 'functions.php';
require_once 'helpers/helper.php';

$email = $_POST['email'];
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

$apiKey = 'cdf68a5e4898a9ec326c3669e9e67b2c-us17'; 
$listID = 'd87b4b35fa'; 
// MailChimp API URL 
$memberID = md5(strtolower($email)); $dataCenter = substr($apiKey,strpos($apiKey,'-')+1); $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID; 
// member information 
$json = json_encode(
            [ 'email_address' => $email, 
            'status' => 'subscribed',
            'tags' => array('Web Subscribers')
            ]); 

// send a HTTP POST request with curl 
$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey); 
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
$result = curl_exec($ch); 
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close($ch); 
// store the status message based on response code 
if ($httpCode == 200 || $httpCode == 214) { 
	return helper::Output_Success(["success"=>"Subscribed"]); 
} else { 
	return helper::Output_Error(null, "Opps there was an error performing this task please try again later"); 
} 


/**
 * CHECK IF A USER EXIST WITH THE EMAIL ADDRESS **/
// $checkSubscriber = getSubscriber($email);
// if(array_key_exists('error',  $checkSubscriber)){
//     return helper::Output_Error(null, "Opps there was an error performing this task please try again later");
// }
// if(mysqli_num_rows($checkSubscriber) > 0){
//     return helper::Output_Success(["success"=>"Subscribed"]);
// }else{
//     $registerSubscriber = insertSubscriber($email);
//     if($registerSubscriber === TRUE){

//         return helper::Output_Success(["success"=>"Subscribed"]);
//     }else{
//         return helper::Output_Error(null, "Opps there was an error performing this task please try again later");
//     }
// } 

?>
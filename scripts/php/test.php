<?php
// require_once('mailchimp/vendor/autoload.php');

// $mailchimp = new \MailchimpMarketing\ApiClient();

// $mailchimp->setConfig([
// 	'apiKey' => 'cdf68a5e4898a9ec326c3669e9e67b2c-us17',
// 	'server' => 'us17'
// ]);
// $email = "urist.mcvankab@example.com";
// $list_id = "d87b4b35fa";

// try {
//     $response = $client->lists->addListMember($list_id, [
//         "email_address" => $email,
//         "status" => "subscribed",
//         "merge_fields" => [
//           "FNAME" => "Prudence",
//           "LNAME" => "McVankab"
//         ]
//     ]);
//     $response = $mailchimp->lists->addListMember($list_id, $contact);
//     // TODO: Get the new member's ID from the response and echo it
//     echo "Successfully added contact as an audience member. The contact's id is {$response->getId()}.";
// } catch (MailchimpMarketing\ApiException $e) {
//     echo $e->getMessage();
// }

$email = 'clinton@gmail.com'; 
$fname = 'clinton';
$lname =  'tuoyo';
// MailChimp API credentials 
$apiKey = 'cdf68a5e4898a9ec326c3669e9e67b2c-us17'; 
$listID = 'd87b4b35fa'; 
// MailChimp API URL 
$memberID = md5(strtolower($email)); $dataCenter = substr($apiKey,strpos($apiKey,'-')+1); $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID; 
// member information 
$json = json_encode(
            [ 'email_address' => $email, 
            'status' => 'subscribed' 
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
if ($httpCode == 200) { 
	echo '<p style="color: #34A853">You have successfully subscribed to CodexWorld.</p>'; 
} else { 
	switch ($httpCode) {
	 case 214: $msg = 'You are already subscribed.'; break; 
	 default: $msg = 'Some problem occurred, please try again.'; break; 
	} 
    echo $msg; 
} 

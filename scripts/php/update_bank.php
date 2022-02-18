<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value 
$bank_name = $_POST["bank_name"];
$bank_acct_name = $_POST["bank_acct_name"]; 
$bank_acct_number = $_POST["bank_acct_number"];
$id = $_POST["id"];

// array for JSON response
$androidResponse = array();


$update = updateAppBank($bank_name, $bank_acct_name, $bank_acct_number, $id);
if($update === TRUE){
    $androidResponse["message"] = 'Your details have been updated';
        // echo JSON response
        echo json_encode($androidResponse);
}else{
   $androidResponse["message"] = 'Network error, try again later';
        // echo JSON response
        echo json_encode($androidResponse);
}
 
?>
<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$fullname = $_POST["fullname"]; 
$phone = $_POST["phone"]; 
$id = $_POST["id"]; 
$address = $_POST['address'];
$relationship = $_POST['relationship'];

// array for JSON response
$androidResponse = array();


$update = updateAppNok($fullname, $id, $phone, $address, $relationship);
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
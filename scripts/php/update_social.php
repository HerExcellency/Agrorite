<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$facebook = $_POST["facebook"]; 
$twitter = $_POST["twitter"]; 
$instagram = $_POST["instagram"];
$id = $_POST["id"];

// array for JSON response
$androidResponse = array();


$update = updateAppSocials($twitter, $facebook, $instagram, $id);
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
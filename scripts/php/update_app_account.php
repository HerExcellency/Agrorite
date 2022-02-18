<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$street_add = $_POST["street_add"]; 
$city = $_POST["city"]; 
$state = $_POST["state"]; 
$country = $_POST["country"];
$id = $_POST["id"];

// array for JSON response
$androidResponse = array();


$update = updateAppAgroriter($street_add, $city, $state, $country, $id);
if($update === TRUE){
    $androidResponse["message"] = 'Your deatils have been updated';
        // echo JSON response
        echo json_encode($androidResponse);
}else{
   $androidResponse["message"] = 'Network error, try again later';
        // echo JSON response
        echo json_encode($androidResponse);
}
 
?>
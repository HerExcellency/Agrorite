<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
require_once 'database1.php';
require_once 'investment.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$investment = new Investment($db);

// set ID property of record to read
$investment->agroriter_id = isset($_GET['id']) ? $_GET['id'] : die();
  
// query investments
$stmt = $investment->read();
$num = $stmt->rowCount();

function getMatVal($percentage, $total){
    $maturity_value = (($percentage / 100) * $total) + $total;
    return $maturity_value;
}
  
// check if more than 0 record found
if($num>0){
  
    // investments array
    $investments_arr=array();
    $investments_arr["records"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $investment_item=array(
            "id" => $id,
            "farm_title" => $farm_title,
            "total" => $total,
            "percentage" => $percentage,
            "mat_val" => number_format(getMatVal($percentage, $total), 2),
            "date_end" => $date_end
        );
  
        array_push($investments_arr["records"], $row);
        // array_push($investments_arr["records"], $investment_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($investments_arr);
}
else{
    
    // investments array
    $investments_arr=array();
    $investments_arr["records"]=array();
    
    $investment_item=array(
            "id" => "",
            "farm_title" => "No Investment yet",
            "total" => "0",
            "percentage" => "",
            "mat_val" => "0.00",
            "date_end" => "NIL"
        );
  
    array_push($investments_arr["records"], $investment_item);
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no investments found
    echo json_encode($investments_arr);
}
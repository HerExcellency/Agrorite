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
$stmt = $investment->getInvoice();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // investments array
    $investments_arr=array();
    $investments_arr["records"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $farmTitle = $investment->getFarm($farm_id);
        $result = $farmTitle->fetch();
        $title = $result['title'];
        $image = $result['app_image'];
        $investment_item=array(
            "id" => $id,
            "title" => $title,
            "image" => $image,
            "amount" => $amount,
            "invoice" => $invoice_code,
            "date_created" => $date_created
        );
  
        array_push($investments_arr["records"], $investment_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($investments_arr);
}

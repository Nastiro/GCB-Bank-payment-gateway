<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Bank.php';

//Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

//Instantiate card object
$bank = new Bank($db);

//Check if request sent was a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//Get the data send by the client
    $data = json_decode(file_get_contents("php://input"));

//set data
    $bank->card_name   = $data->card_name;
    $bank->card_number = $data->card_number;
    $bank->cost        = $data->cost;

//Card query
    $result = $bank->authorize();

//Get row count
    if ($result == true) {
        echo json_encode('Payment Successful');
    } else {
        echo json_encode('Payment failed not enough balance');
    }
}
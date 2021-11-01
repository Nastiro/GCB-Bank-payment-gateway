<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:  Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// //Initialize the session
// session_start();

// //Check is the user is already logged in, if yes then redirect to the home page
// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
//     header('location: http://localhost/gateway/api/client_website/frontend/login.php');
//     exit;
// } else {
//     header('location: http://localhost/gateway/api/client_website/frontend/homepage.php');
// }

include_once '../../config/Database.php';
include_once '../../models/Transactions.php';

//Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

//Instantiate transactions
$transactions = new Transaction($db);

//Check if request sent was a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//Get users input
    $data = json_decode(file_get_contents("php://input"));

//set index number
    $transactions->amount       = $data->amount;
    $transactions->index_number = $data->index_number;
    $transactions->product_name = $data->product_name;

//Check refund successful

    if ($transactions->log_transactions()) {
        echo json_encode(array('message' => 'Logging done'));
    } else {
        echo json_encode(array('message' => 'Logging unsuccessful'));
    }

}
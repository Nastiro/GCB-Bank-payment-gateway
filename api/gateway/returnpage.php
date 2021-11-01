<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

//Initialize the session
session_start();

//check if request sent was a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Get the data sent by the client
    $data = json_decode(file_get_contents("php://input"));

    $details = array(
        'product' => $data->product,
        'cost'    => $data->cost,
    );

    echo json_encode(
        array("redirectURL" => "http://localhost/gateway/api/gateway/frontend/payment.php?product={$data->product}&cost={$data->cost}")
    );
}
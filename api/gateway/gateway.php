<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

//check if request sent was a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Get the data sent by the client
    $data = json_decode(file_get_contents("php://input"));
    $url  = 'http://localhost/gateway/api/card_handler/get_card.php';

    //Send a post request to the bank
    $option = array(
        'http' => array(
            'header'  => "Content-Type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context = stream_context_create($option);
    $result  = file_get_contents($url, false, $context);

    echo json_encode($result);
}
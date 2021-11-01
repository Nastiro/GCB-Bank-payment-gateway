<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Card.php';

//Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

//Instantiate card object
$card = new Card($db);

//Check if request sent was a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//Get the data send by the client
    $data = json_decode(file_get_contents("php://input"));

//set data
    $card->card_name        = $data->card_name;
    $card->card_cvv         = $data->card_cvv;
    $card->card_expire_date = $data->card_expire_date;
    $card->card_number      = $data->card_number;

//Card query
    $result = $card->get_card();

//Get row count
    if ($result == true) {

        //------------------------------------------//
        $url = 'http://localhost/gateway/api/issuerbank/issuerbank.php';

        $option = array(
            'http' => array(
                'header'  => "Content-Type: application/json",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context = stream_context_create($option);
        $result  = file_get_contents($url, false, $context);

        echo json_encode(array('message' => $result));
        //------------------------------------------//
    } else {
        echo json_encode(array('message' => 'invalid card details'));
    }
}
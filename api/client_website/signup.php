<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

//variables for error message
$user_name_err    = "";
$lname_err        = "";
$index_err        = "";
$con_password     = "";
$con_password_err = "";

//Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

//Instantiate User post object
$user = new User($db);

//Processes data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Get raw posted data (from post request)
    $data = json_decode(file_get_contents("php://input"));

    //Check if user_name field is empty
    if (empty(trim($data->user_name))) {
        $user_name_err = "Please enter your first name";
        echo json_encode(array('message' => "$user_name_err"));
        die();

    } else {
        $user->user_name = trim($data->user_name);
    }

    //Check if index_number field is empty
    if (empty(trim($data->index_number))) {
        $index_err = "Please enter your index_number";
        echo json_encode(array('message' => "$index_err"));
        die();

    } else {
        $user->index_number = trim($data->index_number);
    }

    //Check if password field is empty
    if (empty(trim($data->password))) {
        $password_err = "Please enter a password";
        echo json_encode(array('message' => "$password_err"));
        die();

    }
    //Check password length
    elseif (strlen(trim($data->password)) < 6) {
        $password_err = "Password must have at least 6 characters";
        echo json_encode(array('message' => "$password_err"));
        die();

    } else {
        $user->password = trim($data->password);
    }

    //Check if confirm password field is empty
    if (empty(trim($data->confirm_password))) {
        $con_password_err = "Please confirm the passsword";
        echo json_encode(array('message' => "$con_password_err"));
        die();
    }
    //Check if password
    elseif (empty($password_err) && (($data->password) != ($data->confirm_password))) {
        $con_password_err = "Password did not match";
        echo json_encode(array('message' => "$con_password_err"));
        die();

    } else {
        $user->confirm_password = trim($data->confirm_password);
    }

    //If there are no errors... Try sign user up
    if (empty($username_err) && empty($password_err) && empty($confirm_password)) {
        if ($user->signup()) {
            echo json_encode(array('message' => 'User created succesfully'));
        } else {
            echo json_encode(array('message' => 'User not cteated'));
        }
    }
}
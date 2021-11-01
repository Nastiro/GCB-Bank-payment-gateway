<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

//Initialize the session
session_start();

//Redirect to login page
header('Location: http://localhost/gateway/api/gateway/frontend/transactionlist.php');
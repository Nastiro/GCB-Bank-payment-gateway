<?php

class User
{
    //DB Stuff
    private $conn;
    private $table = 'users';

    //User props
    public $index_number;
    public $password;
    public $user_name;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //<--- Logout function
    public function logout()
    {
        session_start();

        //Unset all of the session variables
        unset($_SESSION["loggedin"]);

        //Destroy the session;
        session_destroy();

        return true;
    }

    //<--- Login function
    public function login()
    {
        $query = 'SELECT user_name, index_number, password FROM ' . $this->table . ' WHERE index_number = :index';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean the data
        $this->email = htmlspecialchars(strip_tags($this->index_number));

        //bind the data
        $stmt->BindParam(':index', $this->index_number);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->index_number    = $row['index_number'];
            $this->user_name       = $row['user_name'];
            $this->hashed_password = $row['password'];

            //validate password
            if (password_verify($this->password, $this->hashed_password)) {
                return true;
            } else {
                return false;
            }
        } else {
            //username is incorrect
            return false;
        }

    }

   
}
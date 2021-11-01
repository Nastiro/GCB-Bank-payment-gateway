<?php

class Bank
{
    //DB Stuff
    private $conn;
    private $table = 'issuer_bank';

    //User props
    public $card_name;
    public $card_number;
    public $balance;
    public $cost;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //check client balance
    public function authorize()
    {
        //create query
        $query = 'SELECT name, card_number, balance
        FROM ' . $this->table . '
        WHERE card_number = :c_number';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean the data
        $this->card_number = htmlspecialchars(strip_tags($this->card_number));
        $this->card_name   = htmlspecialchars(strip_tags($this->card_name));
        $this->balance     = htmlspecialchars(strip_tags($this->balance));
        $this->cost        = htmlspecialchars(strip_tags($this->cost));

        //bind the data
        $stmt->BindParam(':c_number', $this->card_number);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Check if name match with card_number
            if ($this->card_name == $row['name']) {
                //Check balance
                if ($row['balance'] >= $this->cost) {
                    $balance = $row['balance'] - $this->cost; //calc new balance

                    $query1 = 'UPDATE ' . $this->table . ' SET balance = :new_balance WHERE card_number= ' . $row['card_number'];
                    $stmt1  = $this->conn->prepare($query1);
                    $stmt1->BindParam(':new_balance', $balance);
                    if ($stmt1->execute()) {
                        return true;
                    }

                    return false; //If query failed to execute
                } else {
                    return false; //not enough balance
                }
            } else {
                return false; //wrong name
            }
        }
    }

    public function refund()
    {
        //create query
        $query = 'SELECT name, card_number, balance
        FROM ' . $this->table . '
        WHERE card_number = :c_number';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean the data
        $this->card_number = htmlspecialchars(strip_tags($this->card_number));
        $this->cost        = htmlspecialchars(strip_tags($this->cost));

        //bind the data
        $stmt->BindParam(':c_number', $this->card_number);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Check if card number entered by the user is equal to the card number in the database
            if ($this->card_number == $row['card_number']) {

                //Update balance
                $balance = $row['balance'] + $this->cost; //calc new balance
                $query1  = 'UPDATE ' . $this->table . ' SET balance = :new_balance WHERE card_number= ' . $row['card_number'];
                $stmt1   = $this->conn->prepare($query1);
                $stmt1->BindParam(':new_balance', $balance);
                if ($stmt1->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false; //wrong card
            }
        }
    }

}
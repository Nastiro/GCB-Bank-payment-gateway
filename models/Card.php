<?php
class Card
{
    //DB Stuff
    private $conn;
    private $table = 'card_handler';

    //Card properties
    public $card_name;
    public $card_number;
    public $card_cvv;
    public $card_expire_date;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get card details
    public function get_card()
    {
        //create query
        $query = 'SELECT card_name, card_number, card_cvv, card_expire_date
        FROM ' . $this->table . '
        WHERE card_number = :c_number';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean the data
        $this->card_number      = htmlspecialchars(strip_tags($this->card_number));
        $this->card_cvv         = htmlspecialchars(strip_tags($this->card_cvv));
        $this->card_name        = htmlspecialchars(strip_tags($this->card_name));
        $this->card_expire_date = htmlspecialchars(strip_tags($this->card_expire_date));

        //bind the data
        $stmt->BindParam(':c_number', $this->card_number);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Check details
            if ($this->card_number == $row['card_number']) {
                if ($this->card_cvv == $row['card_cvv']) {
                    if ($this->card_expire_date == $row['card_expire_date']) {
                        if ($this->card_name == $row['card_name']) {
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        return false;
    }
}
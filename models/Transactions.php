<?php

class Transaction
{
    //DB Stuff
    private $conn;
    private $table = 'transactions';

    //Props
    public $id;
    public $index_number;
    public $product_name;
    public $amount;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Log all transactions
    public function log_transactions()
    {
        $query = 'INSERT INTO ' . $this->table . '
            SET
                index_number = :index_number,
                product_name = :product_name,
                amount = :amount
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean and set data
        $this->index_number = htmlspecialchars(strip_tags($this->index_number));
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->amount       = htmlspecialchars(strip_tags($this->amount));

        //BInd data
        $stmt->BindParam(':index_number', $this->index_number);
        $stmt->BindParam(':product_name', $this->product_name);
        $stmt->BindParam(':amount', $this->amount);

        //Execute query
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    //Get all transactions
    public function get_all_transactions()
    {
        $query = 'SELECT id, product_name, amount FROM ' . $this->table . ' WHERE index_number = :index_number';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean and set data
        $this->index_number = htmlspecialchars(strip_tags($this->index_number));

        //Bind data
        $stmt->BindParam(':index_number', $this->index_number);

        //Execute query
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    //Get refund
    public function get_refund()
    {
        $query2 = 'SELECT id FROM ' . $this->table . ' WHERE id = :id';
        $query  = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //prepare statement
        $stmt  = $this->conn->prepare($query);
        $stmt2 = $this->conn->prepare($query2);

        //Clean and set data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->BindParam(':id', $this->id);
        $stmt2->BindParam(':id', $this->id);

        //Execute
        if ($stmt2->execute()) {
            $row = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($row == 0) {
                return false;
            } else {
                //Execute query
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }
}
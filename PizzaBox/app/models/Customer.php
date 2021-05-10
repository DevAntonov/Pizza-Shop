<?php

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function takenEmailValidation($email)
    {
        $this->db->query('SELECT * FROM customer WHERE email= :email');
        $this->db->bind(':email', $email);
        /*$this->db->execute();*/
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function registerCustomer($data)
    {
        
        $this->db->query('INSERT INTO customer (first_name, email, password) VALUES(:first_name, :email, :password)');
        $this->db->bind(':first_name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['pwd']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function loginCustomer($email, $pwd)
    {
        $this->db->query('SELECT * FROM customer WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->resultRow();
        
        if(!empty($row)){
            $hashedPassword = $row->password; //password as in the table users
        }else{
            return false;
        }

        if(password_verify($pwd, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    public function changeAccountDetails($data) {

        $customerID = $_SESSION['customer_id'];

        $this->db->query(
        'UPDATE customer
        SET first_name = :first_name,
        last_name = :last_name,
        email = :email,
        phone_number = :phone_number
        WHERE id = 1'
        );

        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone_number', $data['phone']);
        //$this->db->bind(':id', $customerID);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}
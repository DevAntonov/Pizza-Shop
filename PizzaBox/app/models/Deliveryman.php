<?php

class Deliveryman
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loginDeliveryman($email, $pwd)
    {
        $this->db->query('SELECT * FROM deliveryman WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->resultRow();
        
        if(!empty($row)){
            $deliverymanPassword = $row->password; 
        }else{
            return false;
        }

        if($pwd == $deliverymanPassword){
            return $row;
        }else{
            return false;
        }
    }
}
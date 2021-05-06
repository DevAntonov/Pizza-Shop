<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function takenEmailValidation($email)
    {
        $this->db->query('SELECT * FROM users WHERE email= :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function registerUser($data)
    {
        
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['pwd']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function loginUser($email, $pwd)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
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

    
    
}
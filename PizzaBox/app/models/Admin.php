<?php

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loginAdmin($admin_name,$pwd)
    {
        $this->db->query('SELECT * FROM admin WHERE admin_name = :admin_name');
        $this->db->bind(':admin_name', $admin_name);
        $row = $this->db->resultRow();
        
        if(!empty($row)){
            $adminPassword = $row->password; //password as in the table admins
        }else{
            return false;
        }

        if($pwd == $adminPassword){
            return $row;
        }else{
            return false;
        }
    }
}
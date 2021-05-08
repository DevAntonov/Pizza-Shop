<?php

class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
    }

    public function login()
    {   
        $data = [
            'admin_name' => '',
            'pwd' => '',
            'admin_name_err' => '',
            'pwd_err' => ''
        ];
        

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'admin_name' => trim($_POST['admin_name']),
                'pwd' => trim($_POST['pwd']),
                'admin_name_err' => '',
                'pwd_err' => ''
            ];

            if(empty($data['admin_name'])){
                $data['admin_name_err'] = 'Please enter your admin name!';
            }
            
            if(empty($data['pwd'])){
                $data['pwd_err'] = 'Please enter your password!';
            }

            if(empty($data['admin_name_err']) && empty($data['pwd_err'])){
                $loggedInAdmin = $this->adminModel->loginAdmin($data['admin_name'],$data['pwd']);
                if($loggedInAdmin){
                    $this->createAdminSession($loggedInAdmin);
                    header('location: '. URLROOT . '/admins/dashboard');
                }else{
                    $data['pwd_err'] = "Incorrect admin name and/or password! ";
                    $this->view('admins/login', $data);
                }
            }

        }else{
            $data = [
                'admin_name' => '',
                'pwd' => '',
                'admin_name_err' => '',
                'pwd_err' => ''
            ];
        }

        $this->view('admins/login', $data);
    }

    public function createAdminSession($admin)
    {
        session_start();
        $_SESSION['loggedinAdmin'] = true;
        $_SESSION['admin_id'] = $admin->user_id;
        $_SESSION['admin_name'] = $admin->name;
    }

    public function logoutAdmin()
    {
        unset($_SESSION['loggedinAdmin']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        header('location: '. URLROOT . '/admins/login');
    }

    public function dashboard()
    {
        $data = [];
        $this->view('admins/dashboard', $data);
    }
}
<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        $data = [
            'email' => '',
            'name' => '',
            'pwd' => '',
            'pwdr' => '',
            'email_err' => '',
            'name_err' => '',
            'pwd_err' => '',
            'pwdr_err' => '',
            'success_msg' => ''
        ];

        // Form validation
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'name' => trim($_POST['name']),
                'pwd' => trim($_POST['pwd']),
                'pwdr' => trim($_POST['pwdr']),
                'email_err' => '',
                'name_err' => '',
                'pwd_err' => '',
                'pwdr_err' => '',
                'success_msg' => ''
            ];
        

            //Validation RegEx
            $nameValidation = "/^[a-zA-Z]*$/";
            $pwdValidation = "/^(.{0,3}|[^a-z]*|[^\d]*)$/i";

            //Name Validation
            if(empty($data['name'])){
                $data['name_err'] = "Please enter your name!";
            }elseif(!preg_match($nameValidation, $data['name'])){
                $data['name_err'] = "Name can only contain letters!";
            }

            //Email Validation
            if(empty($data['email'])){
                $data['email_err'] = "Please enter your email!";
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = "Incorrect email format!";
            }else{
                if($this->userModel->takenEmailValidation($data['email'])){
                    $data['email_err'] = "Email is taken!";
                }
            }

            //Password Validation
            if(empty($data['pwd'])){
                $data['pwd_err'] = "Please enter a password!";
            }elseif(strlen($data['pwd'] < 4 )){
                $data['pwd_err'] = "Password must be at least 4 characters!";
            }elseif(!preg_match($pwdValidation, $data['pwd'])){
                $data['pwd_err'] = "Password must contain at least one numeric value!";
            }

            //Password Confirm Validation
            if(empty($data['pwdr'])){
                $data['pwdr_err'] = "Empty confirm password field";
            }else{
                if($data['pwd'] != $data['pwdr']){
                    $data['pwdr_err'] = "Passwords do not match!";
                }
            }

            //Empty Error Messages check
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['pwd_err']) && empty($data['pwdr_err'])){
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
                if($this->userModel->registerUser($data)){
                    $data['success_msg'] = "You have successfully registered!";
                }else{
                    die('Something went wrong!');
                }
            }
        }

        //Load view
        $this->view('users/register', $data);
    }

    public function login()
    {
        $data = [
            'email' => '',
            'pwd' => '',
            'email_err' => '',
            'pwd_err' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'pwd' => trim($_POST['pwd']),
                'email_err' => '',
                'pwd_err' => ''
            ];

            //Auth user
            //Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter your email!';
            }
            //Password
            if(empty($data['pwd'])){
                $data['email_err'] = 'Please enter your password!';
            }

            //Check for errors
            if(empty($data['email_err']) && empty($data['pwd_err'])){
                $loggedIn = $this->userModel->loginUser($data['email'],$data['pwd']);
                if($loggedIn){
                    $this->createSession($loggedIn);
                    header('location: '. URLROOT . '/users/account');
                }else{
                    $data['pwd_err'] = "Incorrect email and/or password! ";
                    $this->view('users/login', $data);
                }
            }

        }else{
            $data = [
                'email' => '',
                'pwd' => '',
                'email_err' => '',
                'pwd_err' => ''
            ];
        }

        $this->view('users/login', $data);
    }

    public function createSession($user)
    {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->name;
    }

    public function logout()
    {
        unset($_SESSION['loggedin']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        header('location: '. URLROOT . '/index');
    }

    public function account()
    {
        $this->view('users/account');
    }
}
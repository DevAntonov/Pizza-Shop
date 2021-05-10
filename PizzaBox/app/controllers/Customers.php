<?php

class Customers extends Controller
{
    public function __construct()
    {
        $this->customerModel = $this->model('Customer');
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
                if($this->customerModel->takenEmailValidation($data['email'])){
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
                if($this->customerModel->registerCustomer($data)){
                    $data['success_msg'] = "You have successfully registered!";
                }else{
                    die('Something went wrong!');
                }
            }
        }

        //Load view
        $this->view('customers/register', $data);
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
                $data['pwd_err'] = 'Please enter your password!';
            }

            //Check for errors
            if(empty($data['email_err']) && empty($data['pwd_err'])){
                $loggedIn = $this->customerModel->loginCustomer($data['email'],$data['pwd']);
                if($loggedIn){
                    $this->createSession($loggedIn);
                    header('location: '. URLROOT . '/customers/account');
                }else{
                    $data['pwd_err'] = "Incorrect email and/or password! ";
                    $this->view('customers/login', $data);
                }
            }

        }/*else{
            $data = [
                'email' => '',
                'pwd' => '',
                'email_err' => '',
                'pwd_err' => ''
            ];
        }*/

        $this->view('customers/login', $data);
    }

    public function details() 
    {

        $data = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '',
            'first_name_err' => '',
            'last_name_err' => '',
            'email_err' => '',
            'phone_err' => '',
            'success_msg' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'phone_err' => '',
                'success_msg' => ''
            ];
            
            //Validation RegEx
            $nameValidation = "/^[a-zA-Z]*$/";
            $phoneValidation = "/^\\d{10}$/";

            //First name validation
            if(empty($data['first_name'])){
                $data['first_name_err'] = "Please enter your first name!";
            }elseif(!preg_match($nameValidation, $data['first_name'])){
                $data['first_name_err'] = "First name can only contain letters!";
            }

            //Last name validation
            if(empty($data['last_name'])){
                $data['last_name_err'] = "Please enter your last name!";
            }elseif(!preg_match($nameValidation, $data['last_name'])){
                $data['last_name_err'] = "Last name can only contain letters!";
            }

            //Email Validation
            if(empty($data['email'])){
                $data['email_err'] = "Please enter your email!";
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = "Incorrect email format!";
            }else{
                if($this->customerModel->takenEmailValidation($data['email'])){
                    $data['email_err'] = "Email is taken!";
                }
            }
            
            //phone validation
            if(empty($data['phone'])){
                $data['phone_err'] = "Please enter your phone number!";
            }elseif(!preg_match($phoneValidation, $data['phone'])){
                $data['phone_err'] = "Phone number can only contain 10 digits!";
            }

            //Empty Error Messages check
            if(empty($data['email_err']) && empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['phone_err'])){
                if($this->customerModel->changeAccountDetails($data)){
                    $data['success_msg'] = "You have successfully changed your details!";
                }else{
                    die('Something went wrong!');
                }
            }
        }

        $this->view('customers/account',$data);
    }

    public function createSession($customer)
    {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['customer_id'] = $customer->id;
        $_SESSION['customer_name'] = $customer->first_name;
    }

    public function logout()
    {
        unset($_SESSION['loggedin']);
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_name']);
        header('location: '. URLROOT . '/index');
    }

    public function account()
    {
        $this->view('customers/account');
    }
}
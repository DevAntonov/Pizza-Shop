<?php

class Home extends Controller{

    public function __construct()
    {
        //$this->userModel = $this->model('User');
    }

    public function index()
    {    
        $data = [];
       /* $users = $this->userModel->getUsers();
        
        $data = [
            'users' => $users
        ];*/
        $this->view('index', $data);
    }
}
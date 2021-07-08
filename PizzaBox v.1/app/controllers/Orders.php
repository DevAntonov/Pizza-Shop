<?php

class Orders extends Controller
{
    public function __construct()
    {
        $this->orderModel = $this->model('Order');
    }

    public function menu()
    {
        $data=[];
        $this->view('orders/menu',$data);
    }

    public function item()
    {
        $data=[];
        $this->view('orders/item',$data);
    }


}
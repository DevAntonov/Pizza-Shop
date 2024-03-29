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

    public function cart()
    {
        $data=[];
        $this->view('orders/cart',$data);
    }

    public function addToCart()
    {
        $data = [
            'quantity_err' => '',
            'all_products_removed_err' => '',
            'success_msg' => ''
        ];

        $quantityValidation = "/[1-9]/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(!empty($_POST['remove_products'])){
                if($this->orderModel->allProductsRemoved($_POST['remove_products'], $_POST['menu_item_name'])){
                    $data['all_products_removed_err'] = "All products were removed! Please have at least one unchecked box!";
                }
            }
            if(!preg_match($quantityValidation, $_POST['quantity'])){
                $data['quantity_err'] = "Please input a numeric quantity between 1 and 10";
            }

            if(empty($data['qunatity_err']) && empty($data['all_products_removed_err'])){
                
                $item_name = $_POST['menu_item_name'];
                if(!empty($_POST['remove_products'])){
                    $description = $this->orderModel->getOrderDescriptionRemoved($_POST['remove_products'], $_POST['menu_item_name']);
                }else{
                    $description = $this->orderModel->getOriginalDescription($_POST['menu_item_name']);
                }
                if(empty($_POST['add_supplements'])){
                    $supplements = "None";
                }else{
                    $supplements = implode(", ",$_POST['add_supplements']);
                }
                $quantity = $_POST['quantity'];
                $total = $this->orderModel->getTotalCost($_POST['menu_item_name'], $quantity);

                $order_item = array();
                array_push($order_item, $item_name, $description, $supplements,$quantity,$total);
                //print_r($order_item);
                array_push($_SESSION['cart'], $order_item );
                $data['success_msg'] = "Item added successfully to cart!";
                //print_r($_SESSION['cart']);
            }else{
                $this->view('orders/item',$data);
            }
        }
        $this->view('orders/item',$data);
    }


}
<?php

class Orders extends Controller
{
    private $items = [];

    public function __construct()
    {
        $this->orderModel = $this->model('Order');

        // Get shopping cart from session
        $this->items = !empty($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : NULL;

        // Set initial values
        if ($this->items === NULL) {
            $this->items = ['total_price' => 0, 'total_items' => 0]; 
        }
    }

    public function menu()
    {
        $data=[];
        $this->view('orders/menu',$data);
    }

    public function cart()
    {
        $this->view('orders/cart');
    }


    // Cart functions
    public function cartControl()
    {
        $action = $_POST['Action'];

        switch ($action) {
            case 'Add':
                if(!empty($_POST['quantity'])) {

                    $menuItem = $this->orderModel->getMenuItemByID($_POST['item']);
                    $itemData = [
                        'id' => $menuItem->id,
                        'name' => $menuItem->name,
                        'price' => $menuItem->price,
                        'qty' => $_POST['quantity']
                    ];
                    
                    $this->add_item($itemData);
                }
                break;
            
            case "Remove":
                if(!empty($_SESSION['shopping_cart'])) {
                    $this->remove_item($_POST['item']);
                }
                break;
            default:
                echo "Something went wrong!";
                break;
        }

        $this->view('orders/cart');
    }

    public function get_item($item_id) {
        $bool_expression = (in_array($item_id, array('total_items', 'total_price'), TRUE) OR ! isset($this->items[$item_id]));

        return $bool_expression ? FALSE : $this->items[$item_id]; 
    }

    public function total_items(){ 
        return $this->items['total_items']; 
    } 

    public function total_price(){ 
        return $this->items['total_price']; 
    } 

    public function add_item($item = []){ 
        if(!is_array($item) OR count($item) === 0) {
            return FALSE;
        } else {

            if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])) { 
                return FALSE; 
            }else{

                if($item['qty'] == 0){ 
                    return FALSE; 
                }

                $item_id = $item['id']; 
                $old_qty = isset($this->items[$item_id]['qty']) ? $this->items[$item_id]['qty'] : 0; 
                // re-create the entry with unique identifier and updated quantity 
                $item['item_id'] = $item_id; 
                $item['qty'] += $old_qty; 
                $this->items[$item_id] = $item; 
                 
                // save Cart Item 
                if($this->save_cart()){ 
                    return isset($item_id) ? $item_id : TRUE; 
                }else{ 
                    return FALSE; 
                } 
            } 
        } 
    }
    
    public function update($item = []){ 
        if (!is_array($item) OR count($item) === 0){ 
            return FALSE; 
        }else{ 

            if (!isset($item['item_id'], $this->items[$item['item_id']])){ 
                return FALSE; 
            }else{ 
            
                if(isset($item['qty'])){ 
                    // remove the item from the cart, if quantity is zero 
                    if ($item['qty'] == 0){ 
                        unset($this->items[$item['item_id']]); 
                        return TRUE; 
                    } 
                } 
                 
                // find updatable keys 
                $keys = array_intersect(array_keys($this->items[$item['item_id']]), array_keys($item)); 

                // product id & name shouldn't be changed 
                foreach(array_diff($keys, array('id', 'name')) as $key){ 
                    $this->items[$item['item_id']][$key] = $item[$key]; 
                } 
                // save cart data 
                $this->save_cart(); 
                return TRUE; 
            } 
        } 
    }

    private function save_cart(){ 
        $this->items['total_items'] = $this->items['total_price'] = 0; 
        foreach ($this->items as $key => $val){ 
            // make sure the array contains the proper indexes 
            if(!is_array($val) OR !isset($val['price'], $val['qty'])){ 
                continue; 
            } 
      
            $this->items['total_price'] += ($val['price'] * $val['qty']); 
            $this->items['total_items'] += $val['qty']; 
            $this->items[$key]['subtotal'] = ($this->items[$key]['price'] * $this->items[$key]['qty']); 
        } 
         
        // if cart empty, delete it from the session 
        if(count($this->items) <= 2){ 
            unset($_SESSION['shopping_cart']); 
            return FALSE; 
        }else{ 
            $_SESSION['shopping_cart'] = $this->items; 
            return TRUE; 
        } 
    } 

    public function remove_item($item_id){ 
        // unset & save 
        unset($this->items[$item_id]); 
        $this->save_cart(); 
        return TRUE; 
    }

    public function checkout() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'customer_id' => $_SESSION['customer_id'],
                'status' => 'Pending',
                'total' => $_SESSION['shopping_cart']['total_price'],
            ];

            if($orderID = $this->orderModel->placeOrder($data)){

                $ShoppingCart = $_SESSION['shopping_cart'];

                // Reverse the array of items so the newest items be first
                $ShoppingCart = array_reverse($ShoppingCart);
            
                // Unset these so they don't show up in cart listing
                unset($ShoppingCart['total_items']); 
                unset($ShoppingCart['total_price']); 

                foreach ($ShoppingCart as $value) {
                    $data = [
                        'menu_item_id' => $value['id'],
                        'order_id' => $orderID,
                        'quantity' => $value['qty'],
                    ];

                    if($this->orderModel->placeOrderDetails($data)){
                        echo "Success!";
                    } else {
                        die('Something went wrong!');
                    }
                }

            }else{
                die('Something went wrong!');
            }
        }

        if(!empty($_SESSION['shopping_cart'])) {
            $_SESSION['shopping_cart'] = [];
        }

        $this->view('orders/cart');
    }
}

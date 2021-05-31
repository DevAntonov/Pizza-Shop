<?php

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMenuItemByID($menuItemID) {
        $MenuItemById = $this->db->query("SELECT * FROM menu_item WHERE id = :id");
        $this->db->bind(':id', $menuItemID);
        $row = $this->db->resultRow();

        return $row;
    }

    public function placeOrder($data) {
        $this->db->query('INSERT INTO orders (customer, status, total) VALUES(:customer, :status, :total)');
        $this->db->bind(':customer', $data['customer_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':total', $data['total']);

        if($this->db->execute()){
            $this->db->query('SELECT LAST_INSERT_ID();'); 
            $orderID; 

            foreach ($this->db->resultRow() as $value) {
                $orderID = $value;
            }

            return $orderID;

        }else{
            return false;
        }
    }

    
    public function placeOrderDetails($data) {
        $this->db->query('INSERT INTO order_details (menu_item, order_id, quantity) VALUES(:menu_item, :order_id, :quantity)');
        $this->db->bind(':menu_item', $data['menu_item_id']);
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':quantity', $data['quantity']);

        if($this->db->execute()){  
            return true;
        }else{
            return false;
        }
    }
    

    public function getInfoAboutPendingOrders() {
        $this->db->query('SELECT o.id, c.first_name, c.last_name, c.address, c.phone_number
         FROM orders o INNER JOIN order_details od on o.id = od.order_id 
         INNER JOIN customer c on o.customer = c.id WHERE status = "Pending" ORDER BY o.id;');

        $rows = $this->db->resultArray();

        return $rows;
    }

    public function getOrderDetails($orderID) {
        $this->db->query('SELECT order_id, menu_item, quantity From order_details WHERE order_id = 4;');
        $rows = $this->db->resultArray();

        return $rows;
    }
}
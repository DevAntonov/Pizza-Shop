<?php

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function allProductsRemoved($removed, $itemRemovedFrom)
    {
        $this->db->query('SELECT description FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$itemRemovedFrom);

        $data = $this->db->resultArray();
        $description = $data[0]['description'];
        $description_separated_items = explode(',',$description);

        $countAllRemoved = count($removed);
        $countOriginal = count($description_separated_items);

        if($countAllRemoved == $countOriginal){
            return true;
        }else{
            return false;
        }
    }

    public function getOrderDescriptionRemoved($removed, $itemRemovedFrom)
    {
        $this->db->query('SELECT description FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$itemRemovedFrom);

        $data = $this->db->resultArray();
        $description = $data[0]['description'];
        $description_separated_items = explode(',',$description);

        for($i=0; $i<count($description_separated_items); $i++){
            for($j=0; $j<count($removed); $j++){
                if($removed[$j]==$description_separated_items[$i]){
                    array_splice($description_separated_items, $i,1);
                }
            }
        }

        $description_separated_items = implode(',',$description_separated_items);

        return $description_separated_items;
    }

    public function getOriginalDescription($menu_item)
    {
        $this->db->query('SELECT description FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$menu_item);

        $data = $this->db->resultArray();
        $description = $data[0]['description'];
        $description_separated_items = explode(',',$description);

        $description_separated_items = implode(',',$description_separated_items);
        
        return $description_separated_items;
    }

    public function getTotalCost($product_name, $quantity)
    {
        $this->db->query('SELECT price FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$product_name);

        $price=$this->db->resultArray();
        $totalCost = $price[0]['price'] * $quantity;

        return $totalCost;
    }

    
}
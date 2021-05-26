<?php

//variable $data is used to store associative array

function displayCategoryOptions()
{
    $db = new Database();
    $db->query('SELECT ctg_name FROM category');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['ctg_name']).'">'.strval($value['ctg_name']).'</option>';
    }
}

function displayTypeOptions()
{
    $db = new Database();
    $db->query('SELECT name FROM product_type');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['name']).'">'.strval($value['name']).'</option>';
    }
}

function displayItemOptions()
{
    $db = new Database();
    $db->query('SELECT name FROM product_item');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['name']).'">'.strval($value['name']).'</option>';
    }
}

function displayMenuItemOptions()
{
    $db = new Database();

    $db->query('SELECT type_name, name FROM product_item ORDER BY type_name');

    $data = $db->resultArray();

    $previousValue = '';

    foreach($data as $value)
    {
        $currentProductType=$value['type_name'];


        if($currentProductType != $previousValue){
            echo '<legend class="products_legend">'.strval($value['type_name']).'</legend>';
        }

        echo '<label class="gen_lbl">'.strval($value['name']).'';
        echo '<input type="checkbox" id="'.strval($value['name']).'" name="products[]" value="'.strval($value['name']).'">';
        echo '</label>';

        $previousValue = $currentProductType;
        
    }

}

function displayMenuID()
{
    $db = new Database();

    $db->query('SELECT id FROM menu_item');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    foreach($data as $value)
    {
        echo'<option value="'.strval($value['id']).'">'.strval($value['id']).'</option>';
    }

}

function displayMenuItems()
{
    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid ORDER BY category_id');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    $previousCategory = '';

    foreach($data as $value)
    {
        $currentCategory = $value['category_id']; 

        if($currentCategory != $previousCategory){
            echo '<div class="exclude"';
            echo '<h2>'.strval($value['ctg_name']).'</h2>';
            echo '<hr class="hr_border">';
            echo '</div>';
        }

        echo 
        '<div class="menu_flex_container">
            <form action="/PizzaBox/orders/cart" method="post" class="form_menu">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Product ID: <b>'.$value['id'].'</b></p>
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <input type="hidden" name="item" value="'.$value['id'].'"/>
            <button type="submit" name="add" class="btn_add">Add</button>
            </form>
        </div>';

        $previousCategory = $currentCategory;
    }

}

function displayMenuHot()
{

    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid ORDER BY category_id');
    $data = $db->resultArray();

    $previousCategory = '';

    foreach($data as $value)
    {
        $currentCategory = $value['category_id']; 

        if($currentCategory == $previousCategory){
            continue;
        }

        echo 
            '<div class="menu_flex_container">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <a href="/PizzaBox/customers/login" class="a_link_box">Order Now</a>
            </div>';

        $previousCategory = $currentCategory;

        }
   }
   
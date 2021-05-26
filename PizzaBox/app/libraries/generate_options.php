<?php

//variable $data is used to store associative array

function displayCategoryOptions()
{
    $db = new Database();
    $db->query('SELECT name FROM category');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['name']).'">'.strval($value['name']).'</option>';
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

    foreach($data as $value)
    {
        echo'<option value="'.strval($value['id']).'">'.strval($value['id']).'</option>';
    }

}
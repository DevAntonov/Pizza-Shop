<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['remove'])){
            array_splice($_SESSION['cart'], $_POST['item'],1);
            echo 'here';
            header('location:'. URLROOT . '/orders/cart');
        }
    }
        
?>

<div id="cart_details">
<?php $totalCost = 0;?>
<h1 class="h1_cart">Order Details</h1>
<div id="order_table">
<table class="table_style">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Supplements</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Remove</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
            $index = 0;
            foreach($_SESSION['cart'] as $item)
            {
                echo'
                <tr> 
                    <td>'.
                        $item['0']
                    .'</td>
                    <td>'.
                        $item['1']
                    .'</td>
                    <td>'.
                        $item['2']
                    .'</td>
                    <td>'.
                        $item['3']
                    .'</td>
                    <td>'.
                        $item['4']
                    .'</td>
                    <td>
                    <form action='.URLROOT.'/orders/cart method="post">
                        <input type="hidden" name="item" value="'.$index.'"/>
                        <button type="submit" name="remove" class="btn_remove">X</button>
                    </form>
                    </td>
                </tr>
                ';
                $index +=1;
                $totalCost += $item['4'];
            }   
        ?>
    </tbody>
</table>

</div>
<div id="checkout_div">
    <h1 class="h1_cart">Total Cost:</h1>
    <p class="total_cost">&euro;<?php echo $totalCost;?></p>
    <button type="submit" name="checkout" class="btn_checkout">Checkout</button>
</div>
</div>



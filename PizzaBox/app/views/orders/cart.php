<?php 
    if(!isLoggedIn()){
        header('location: '. URLROOT . '/users/login');
    }

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content ="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PizzaBox/public/css/style.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-header.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-account.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-errors.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-cart.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
        <title>My cart</title>
    </head>

    <body>

        <?php
            require APPROOT . '/views/includes/navigation.php';
        ?>

        <main>
            <section id="pizza_section">
                <?php 
                    if(!empty($_SESSION['shopping_cart'])) {
                        displayCartItems();
                    } else {
                        echo "Empty cart!";
                    }
                ?>
            </section>
            <div>
                <?php
                    if(!empty($_SESSION['shopping_cart'])) {
                        echo "<p id='total_price'>Total price: ".$_SESSION['shopping_cart']['total_price']." </p>
                        <form action='/PizzaBox/orders/checkout' method='post' class='form_menu'>
                        <button type='submit' class='btn_order'>Order</button>
                        </form>";
                    }
                ?>
            </div>
        </main>

        <?php
            require APPROOT . '/views/includes/footer.php';
        ?>

    </body>

</html>
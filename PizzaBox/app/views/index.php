<!DOCTYPE html>
<html>

<?php
    require APPROOT . '/views/includes/head.php';
?>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>
<section id="landing_page">
    <div class="crop_img">
        <img id="home_img" src="/PizzaBox/public/images/pizzadisplay.jpg">
    </div>
    <div id="text_box">
        <img id="logo_img" src ="/PizzaBox/public/images/pizzaboxlogotr.png">
        <a href="<?php echo URLROOT; ?>/users/login" class="a_link">Order Now</a>
    </div>
</section>
<div class="separator_box">
</div>
<section id="about">
    <div id="abt_box">
        <h2>About PizzaBox</h2>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel semper ipsum, id accumsan turpis.
        Donec ullamcorper dapibus nulla. Pellentesque commodo, dolor at commodo commodo, risus leo laoreet quam, 
        vitae iaculis lectus nisi a erat. Fusce viverra consequat sagittis. Nullam euismod tincidunt urna et tristique. 
        Sed egestas risus ac tincidunt faucibus.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </p>
        </div>
    <div class="parallax_effect"></div>
    
</section>
<div class="separator_box2">
</div>
</main>

<?php
    require APPROOT . '/views/includes/footer.php';
?>

<script src="/PizzaBox/public/javascript/script.js"></script>
</body>
</html>
<header id="header">
    <h1 class="style_h1">PizzaBox</h1>
    <nav class="navigation_bar">
        <ul class="nav_links">
            <?php if(!isLoggedIn()) : ?>
            <li>
                <a href="<?php echo URLROOT ?>/index">Home</a>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>#hot">Hot</a>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>#about">About</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/customers/register">Register</a>
            </li>
            <?php endif; ?> 
            <?php if(isLoggedIn()) : ?>
            <li>
                <a href="<?php echo URLROOT ?>/customers/account">Account</a>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/orders/menu">Menu</a>
            </li>
            <?php endif; ?> 
            <li>
                <?php if(!isLoggedIn()) : ?>
                    <a href="<?php echo URLROOT; ?>/customers/login">Login</a>
                <?php else : ?>
                    <a href="<?php echo URLROOT; ?>/customers/logout">Logout</a>
                <?php endif; ?>    
            </li>
        </ul>
    </nav>
</header>
<?php 
    if(!isLoggedIn()){
        header('location: '. URLROOT . '/users/login');
    }

?>

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
<section id="pizza_section">

</section>


</main>

</body>
</html>
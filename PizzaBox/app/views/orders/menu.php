<?php 
    if(!isLoggedIn()){
        header('location: '. URLROOT . '/customers/login');
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>Menu</title>
</head>

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

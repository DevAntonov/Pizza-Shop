<?php 
	if(!isLoggedIn()){
		header('location: '. URLROOT . '/customers/login');
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

</body>

</html>

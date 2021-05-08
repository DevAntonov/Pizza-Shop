<?php
    if(!isLoggedInAdmin()){
		header('location: '. URLROOT . '/admins/login');
	}

?>

<!DOCTYPE html>
<html>
<?php
    require APPROOT . '/views/includes/head.php';
?>

<body>
<?php
    require APPROOT . '/views/includes/navadmin.php';
?>


</body>
</html>

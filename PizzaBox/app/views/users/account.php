<?php 
	if(!isLoggedIn()){
		header('location: '. URLROOT . '/users/login');
	}
?>

<h2>Account page</h2>

<a href=" <?php echo URLROOT; ?>/users/logout">Log out</a>

<?php var_dump($_SESSION)?>
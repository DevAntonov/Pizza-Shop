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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>Account</title>
</head>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>
<section id="account_page">
	<div id="flex_account_page">
		<div id="account_nav">
			<img id="logo_img_nav" src ="/PizzaBox/public/images/pizzaboxlogotr.png">
			<button onclick="displayDetailsForm()" id="btn_acc_info" class="btn">Account</button>
			<br>
			<button onclick="displayPasswordForm()" id="btn_pass" class="btn">Password</button>
			<br>
			<button onclick="displayAddressForm()" id="btn_address" class="btn">Address*</button>
			<br>
		</div>
		<div class="wrap_acc">
			<div id="acc_details">
				<h2 class="acc_h2_style">Account Details</h1>
				<form action="<?php echo URLROOT ;?>/customers/account" method="post" class="form_style">
					<label class="acc_lbl">First name: 
					<input type="text" name="first_name" class="input_field_acc" placeholder="First Name">
					</label>
					<label class="acc_lbl">Last name: 
					<input type="text" name="last_name" class="input_field_acc" placeholder="Last Name" required>
					</label>
					<label class="acc_lbl">Email: 
					<input type="text" name="email" class="input_field_acc" placeholder="Email">
					</label>
					<label class="acc_lbl">Phone number: 
					<input type="tel" name="phone" class="input_field_acc" placeholder="Phone" required>
					</label>
					<button type="submit" name="submit_update" class="btn_update">Update</button>
					
				</form>
			</div>
			<div id="acc_pass">
				<h2 class="acc_h2_style">Password</h2>
					<form action="<?php echo URLROOT ;?>/customers/account" method="post" class="form_style">
					<label class="acc_lbl">Current Password: 
					<input type="password" password="current_pwd" class="input_field_acc" placeholder="Current Password" required>
					</label>
					<label class="acc_lbl">New Password: 
					<input type="password" name="new_pwd" class="input_field_acc" placeholder="New Password" required>
					</label>
					<label class="acc_lbl">Confirm Password: 
					<input type="password" name="repeat_pwd" class="input_field_acc" placeholder="Repeat Password" required>
					</label>
					<button type="submit" name="submit_pwd_update" class="btn_update">Change Password</button>
				</form>
			</div>
			<div id="acc_address">
				<h2 class="acc_h2_style">Address</h2>
					<form action="<?php echo URLROOT ;?>/customers/account" method="post" class="form_style">
					<label class="acc_lbl">City*: 
					<input type="text" text="city" class="input_field_acc" placeholder="City" required>
					</label>
					<label class="acc_lbl">Street*: 
					<input type="text" text="street" class="input_field_acc" placeholder="Street" required>
					</label>
					<label class="acc_lbl">Street Number*: 
					<input type="text" name="street_num" class="input_field_acc" placeholder="Street Number" required>
					</label>
					<label class="acc_lbl">Building: 
					<input type="text" name="building" class="input_field_acc" placeholder="Building">
					</label>
					<label class="acc_lbl">Entrance: 
					<input type="text" text="entrance" class="input_field_acc" placeholder="Entrance">
					</label>
					<label class="acc_lbl">Floor: 
					<input type="text" text="floor" class="input_field_acc" placeholder="Floor">
					</label>
					<label class="acc_lbl">Apartment: 
					<input type="text" text="apartment" class="input_field_acc" placeholder="Apartment">
					</label>
					<label class="acc_lbl">Bell: 
					<input type="text" text="bell" class="input_field_acc" placeholder="Bell">
					</label>
					<button type="submit" name="submit_update" class="btn_update">Confirm Address</button>
				</form>
			</div>
		</div>
	</div>
</section>


</main>

<?php
    require APPROOT . '/views/includes/footer.php';
?>

<script src="/PizzaBox/public/javascript/account.js"></script>
</body>
</html>
